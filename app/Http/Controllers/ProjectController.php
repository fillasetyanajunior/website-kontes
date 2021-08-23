<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\DetailContest;
use App\Models\DetailProject;
use App\Models\JobCatagories;
use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use App\Models\Project;
use App\Models\ProjectPayment;
use App\Models\SubCatagories;
use Illuminate\Http\Request;

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
            'namepengirimpayment'   => 'required',
            'nomerpayment'          => ['required','numeric'],
        ]);

        $catagories     = Catagories::where('id', $request->catagories)->first();


        if ($request->addprojectupgrades != null) {
            $opsiupgrade    = OpsiPackageUpgrade::where('id',$request->addprojectupgrades) ->first();
            $waktu          = 6 + $opsiupgrade->hari;
        }else {
            $waktu          = 6;
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

        $id =   Project::create([
                    'user_id'               => request()->user()->id,
                    'id_project'            => $idproject,
                    'title'                 => $request->title,
                    'catagories_project'    => 'contest',
                    'catagories'            => $catagories->name,
                    'is_active'             => 'waitting payment',
                    'deadline'              => date('Y-m-d',strtotime('+' . $waktu . ' days')),
                    'harga'                 => $request->totalcost,
                ]);
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('contest', $name);

            DetailContest::create([
                'project_id'        => $id->id,
                'title'             => $request->title,
                'description'       => $request->description,
                'title_logo'        => $request->logo_text,
                'catagories'        => $request->catagories,
                'subcatagories'     => $request->subcatagories,
                'package'           => $request->addpackage,
                'packageupgrade'    => $request->addprojectupgrades,
                'thumnail'          => $name,
                'harga'             => $request->totalcost,
            ]);
        } else {
            DetailContest::create([
                'project_id'        => $id->id,
                'title'             => $request->title,
                'description'       => $request->description,
                'title_logo'        => $request->logo_text,
                'catagories'        => $request->catagories,
                'subcatagories'     => $request->subcatagories,
                'package'           => $request->addpackage,
                'packageupgrade'    => $request->addprojectupgrades,
                'harga'             => $request->totalcost,
            ]);
        }
        ProjectPayment::create([
            'user_id'           => request()->user()->id,
            'id_project'        => $idproject,
            'project_id'        => $id->id,
            'invoicepayment'    => $request->title,
            'name'              => $request->namepengirimpayment,
            'nomerpayment'      => $request->nomerpayment,
        ]);
        return redirect('/home')->with('status','Add contest project success');
    }
    public function IndexDirectProject()
    {
        $data['jobcatagories'] = JobCatagories::all();
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
            'namepengirimpayment'   => 'required',
            'nomerpayment'          => ['required', 'numeric'],
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
                    'is_active'             => 'waitting payment',
                    'deadline'              => date('Y-m-d',strtotime('+' . $request->timeline . 'days')),
                    'harga'                 => $request->budget,
                ]);
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('direct', $name);

            DetailProject::create([
                'project_id'        => $id->id,
                'title'             => $request->title,
                'description'       => $request->description,
                'job_description'   => $request->job_description,
                'thumnail'          => $name,
                'harga'             => $request->budget,
            ]);
        } else {
            DetailProject::create([
                'project_id'        => $id->id,
                'title'             => $request->title,
                'description'       => $request->description,
                'job_description'   => $request->job_description,
                'harga'             => $request->budget,
            ]);
        }
        ProjectPayment::create([
            'user_id'           => request()->user()->id,
            'id_project'            => $idproject,
            'project_id'        => $id->id,
            'invoicepayment'    => $request->title,
            'name'              => $request->namepengirimpayment,
            'nomerpayment'      => $request->nomerpayment,
        ]);
        return redirect('/home')->with('status','Add direct project success');
    }
}
