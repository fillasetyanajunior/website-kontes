<?php

namespace App\Http\Controllers;

use App\Mail\PaymentValidationEmail;
use App\Mail\PembayaranProjectMail;
use App\Models\Catagories;
use App\Models\Code;
use App\Models\DetailContest;
use App\Models\DetailProject;
use App\Models\JobCatagories;
use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use App\Models\Project;
use App\Models\ProjectPayment;
use App\Models\SubCatagories;
use App\Models\UploadFilePerjanjian;
use App\Models\UploadFileProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    public function GetCatagories(Catagories $catagories)
    {
        $subcata = SubCatagories::where('catagori_id', $catagories->id)->get();
        return response()->json([
            'subcatagories' => $subcata,
        ]);
    }
    public function IndexContestProject()
    {
        $data['title']                  = 'Create Contest Project';
        $data['catagories']             = Catagories::all();
        $data['opsipackage']            = OpsiPackage::all();
        $data['opsipackageupgrade']     = OpsiPackageUpgrade::all();
        return view('customer.project.contestproject',$data);
    }
    public function StoreContestProject(Request $request)
    {
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'logo_text'             => 'required',
            'catagories'            => 'required',
            'subcatagories'         => 'required',
            'addpackage'            => 'required',
            'totalcost'             => 'required',
            'paymentmethod'         => 'required',
        ]);

        $catagories     = Catagories::where('id', $request->catagories)->first();

        if ($request->coupon != null) {
            $opsiupgrade    = Code::where('code',$request->coupon)->delete();
        }

        $no = Project::orderBy('id_project', 'DESC')->first();
        if ($no == null) {
            $idproject = 'PRJT0001';
        } else {
            $nama = substr($no->id_project, 5, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $idproject = 'PRJT' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $idproject = 'PRJT' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $idproject = 'PRJT' . "0" . $tambah;
            } else {
                $idproject = 'PRJT' . $tambah;
            }
        }

        $requpgrade = $request->addprojectupgrades;
        $addprojectupgrades = null;
        $waktu = 6;
        $guaranteed = 'not active';
        if ($requpgrade != null) {
            for ($i = 0; $i < count($requpgrade); $i++) {
                if ($addprojectupgrades == null) {
                    $addprojectupgrades =  $requpgrade[$i];
                } else {
                    $addprojectupgrades =  $addprojectupgrades . '/' . $requpgrade[$i];
                }
                $opsiupgrade    = OpsiPackageUpgrade::where('id', $requpgrade[$i])->first();
                if ($opsiupgrade->name == 'Non Disclosure Agreement (NDA)') {
                    $request->validate([
                        'fileperjanjian' => 'required',
                    ]);
                }elseif ($opsiupgrade->name == 'Urgent') {
                    $request->validate([
                        'dayUrgent' => 'required',
                    ]);
                    if ($waktu == null) {
                        $waktu          = 6 + ($opsiupgrade->hari * $request->dayUrgent);
                    } else {
                        $waktu          = $waktu + ($opsiupgrade->hari * $request->dayUrgent);
                    }
                }elseif($opsiupgrade->name == 'Extended'){
                    $request->validate([
                        'dayExtended' => 'required',
                    ]);
                    if ($waktu == null) {
                        $waktu          = 6 + ($opsiupgrade->hari * $request->dayExtended);
                    } else {
                        $waktu          = $waktu + ($opsiupgrade->hari * $request->dayExtended);
                    }
                }elseif($opsiupgrade->name == '10 Days'){
                    if ($waktu == null) {
                        $waktu          = 6 + ($opsiupgrade->hari);
                    } else {
                        $waktu          = $waktu + ($opsiupgrade->hari);
                    }
                }elseif($opsiupgrade->name == '20 Days'){
                    if ($waktu == null) {
                        $waktu          = 6 + ($opsiupgrade->hari);
                    } else {
                        $waktu          = $waktu + ($opsiupgrade->hari);
                    }
                }else{
                    if($opsiupgrade->name == 'Guaranteed'){
                        $guaranteed = 'active';
                    }
                }
            }
        }

        $id = Project::create([
                'user_id'               => request()->user()->id,
                'id_project'            => $idproject,
                'title'                 => $request->title,
                'catagories_project'    => 'contest',
                'catagories'            => $catagories->name,
                'is_active'             => 'waiting payment',
                'hari'                  => $waktu,
                'guarded'               => $guaranteed,
                'harga'                 => $request->totalcost,
                'shouldhave'            => $request->shouldhave,
                'shouldnothave'         => $request->shouldnothave,
                'desaincard'            => 'not active',
            ]);

        if ($request->hasFile('fileperjanjian')) {
            $files = $request->file('fileperjanjian');
            $namenda = $files->getClientOriginalName();
            $files->storeAs('nda', $namenda);

            UploadFilePerjanjian::create([
                'contest_id'    => $id->id,
                'name'          => $namenda,
            ]);
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('fileproject/AllFileProject' . $id->id, $name);

                UploadFileProject::create([
                    'contest_id'    => $id->id,
                    'name'          => $name
                ]);
            }
        }

        DetailContest::create([
            'project_id'        => $id->id,
            'title'             => $request->title,
            'description'       => $request->description,
            'title_logo'        => $request->logo_text,
            'catagories'        => $request->catagories,
            'subcatagories'     => $request->subcatagories,
            'package'           => $request->addpackage,
            'packageupgrade'    => $addprojectupgrades,
            'harga'             => $request->totalcost,
        ]);

        if ($request->paymentmethod == 1) {
            ProjectPayment::create([
                'user_id'               => request()->user()->id,
                'id_project'            => $idproject,
                'project_id'            => $id->id,
                'payment_id_transaksi'  => $request->id_transaksi,
                'invoicepayment'        => $request->title,
                'name_transaksi'        => $request->name_transaksi,
                'email_transaksi'       => $request->email_transaksi,
                'name'                  => request()->user()->name,
                'email'                 => request()->user()->email,
            ]);
            Mail::to(request()->user()->email)->send(new PaymentValidationEmail($request->id_transaksi,$request->title,$request->totalcost,$request->email_transaksi));
//             Http::post(env('API_WHATSAPP_URL') . 'send-message',[
//                 'number' => request()->user()->phone,
//                 'message' =>    'Thank you for ordering.
// Here are the contest details:' . '

// Transaction ID        : ' . $request->id_transaksi . '
// Title Project            : ' . $request->title . '
// Price                       : ' . '$' . $request->totalcost . '
// Email Transaction   : ' . $request->email_transaksi
//             ]);
        } else {
            ProjectPayment::create([
                'user_id'               => request()->user()->id,
                'id_project'            => $idproject,
                'project_id'            => $id->id,
                'payment_id_transaksi'  => 'Other Banks',
                'invoicepayment'        => $request->title,
                'name_transaksi'        => 'Other Banks',
                'email_transaksi'       => 'Other Banks',
                'name'                  => request()->user()->name,
                'email'                 => request()->user()->email,
            ]);
            Mail::to(request()->user()->email)->send(new PaymentValidationEmail('Other Banks',$request->title,$request->totalcost, 'Other Banks'));
//             Http::post(env('API_WHATSAPP_URL') . 'send-message',[
//                 'number' => request()->user()->phone,
//                 'message' =>    'Thank you for ordering.
// Here are the contest details:' . '

// Transaction ID        : Other Banks' . '
// Title Project            : ' . $request->title . '
// Price                       : ' . '$' . $request->totalcost . '
// Email Transaction   : Other Banks'
//             ]);
        }

        return redirect('/home')->with('status','Add contest project success');
    }
    public function IndexDirectProject()
    {
        $data['title']          = 'Create Direct Project';
        $data['jobcatagories']  = JobCatagories::all();
        return view('customer.project.directproject',$data);
    }
    public function StoreDirectProject(Request $request)
    {
        $request->validate([
            'title'                 => 'required',
            'description'           => 'required',
            'job_description'       => 'required',
            'budget'                => 'required',
            'timeline'              => 'required',
            'paymentmethod'         => 'required',
        ]);

        $no = Project::orderBy('id_project', 'DESC')->first();
        if ($no == null) {
            $idproject = 'PRJT0001';
        } else {
            $nama = substr($no->id_project, 5, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $idproject = 'PRJT' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $idproject = 'PRJT' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $idproject = 'PRJT' . "0" . $tambah;
            } else {
                $idproject = 'PRJT' . $tambah;
            }
        }
        $id =   Project::create([
                    'user_id'               => request()->user()->id,
                    'id_project'            => $idproject,
                    'title'                 => $request->title,
                    'catagories_project'    => 'direct',
                    'catagories'            => 'Direct Project',
                    'is_active'             => 'waiting payment',
                    'hari'                  => 12,
                    'harga'                 => $request->budget,
                    'shouldhave'            => $request->shouldhave,
                    'shouldnothave'         => $request->shouldnothave,
                ]);
        // Mail::to(request()->user()->email)->send(new PembayaranProjectMail($id->id));
        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('fileproject/AllFileProject' . $id->id, $name);

                UploadFileProject::create([
                    'contest_id'    => $id->id,
                    'name'          => $name
                ]);
            }

        }

        DetailProject::create([
            'project_id'        => $id->id,
            'title'             => $request->title,
            'description'       => $request->description,
            'job_description'   => $request->job_description,
            'hari'              => $request->timeline,
            'harga'             => $request->budget,
            'is_active'         => 'active',
        ]);
        if ($request->paymentmethod == 1) {
            ProjectPayment::create([
                'user_id'               => request()->user()->id,
                'id_project'            => $idproject,
                'project_id'            => $id->id,
                'payment_id_transaksi'  => $request->id_transaksi,
                'invoicepayment'        => $request->title,
                'name_transaksi'        => $request->name_transaksi,
                'email_transaksi'       => $request->email_transaksi,
                'name'                  => request()->user()->name,
                'email'                 => request()->user()->email,
            ]);
            Mail::to(request()->user()->email)->send(new PaymentValidationEmail($request->id_transaksi, $request->title, $request->totalcost, $request->email_transaksi));
//             Http::post(env('API_WHATSAPP_URL') . 'send-message', [
//                 'number' => request()->user()->phone,
//                 'message' =>    'Thank you for ordering.
// Here are the contest details:' . '

// Transaction ID        : ' . $request->id_transaksi . '
// Title Project            : ' . $request->title . '
// Price                       : ' . '$' . $request->totalcost . '
// Email Transaction   : ' . $request->email_transaksi
//             ]);
        } else {
            ProjectPayment::create([
                'user_id'               => request()->user()->id,
                'id_project'            => $idproject,
                'project_id'            => $id->id,
                'payment_id_transaksi'  => 'Other Banks',
                'invoicepayment'        => $request->title,
                'name_transaksi'        => 'Other Banks',
                'email_transaksi'       => 'Other Banks',
                'name'                  => request()->user()->name,
                'email'                 => request()->user()->email,
            ]);
            Mail::to(request()->user()->email)->send(new PaymentValidationEmail('Other Banks', $request->title, $request->totalcost, 'Other Banks'));
//             Http::post(env('API_WHATSAPP_URL') . 'send-message', [
//                 'number' => request()->user()->phone,
//                 'message' =>    'Thank you for ordering.
// Here are the contest details:' . '

// Transaction ID        : Other Banks' . '
// Title Project            : ' . $request->title . '
// Price                       : ' . '$' . $request->totalcost . '
// Email Transaction   : Other Banks'
//             ]);
        }
        return redirect('/home')->with('status','Add direct project success');
    }
}
