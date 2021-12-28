<?php

namespace App\Http\Controllers;

use App\Models\Catagories;
use App\Models\Code;
use App\Models\Icon;
use App\Models\JobCatagories;
use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use App\Models\SortCatagories;
use App\Models\SubCatagories;
use App\Models\UploadFilePerjanjian;
use Illuminate\Http\Request;

class ManagementWebsiteController extends Controller
{
    public function Catagories()
    {
        $data['title']          = 'Catagories';
        $data['search']         =  SortCatagories::all();
        $data['catagories']     = Catagories::all();
        $data['sub_catagories'] = SubCatagories::paginate(10);
        $data['icon']           = Icon::all();
        return view('admin.managementwebsite.catagories.catagories',$data);
    }
    public function OpsiPackage()
    {
        $data['title']          = 'Opsi Packgaes';
        $data['opsi']           = OpsiPackage::all();
        $data['opsiupgrade']    = OpsiPackageUpgrade::all();
        $data['icon']           = Icon::all();
        return view('admin.managementwebsite.opsi.opsi',$data);
    }
    public function JobCatagories()
    {
        $data['title']          = 'Job Description';
        $data['jobdescription'] = JobCatagories::all();
        return view('admin.managementwebsite.job.job',$data);
    }
    public function Code()
    {
        $data['title']  = 'Code Promo';
       $data['code']    = Code::all();
       return view('admin.managementwebsite.code.code',$data);
    }
    public function NDA()
    {
        $data['title']      = 'NDA';
        $data['perjanjian'] = UploadFilePerjanjian::orderBy('created_at','DESC')->paginate(20);
        return view('admin.nda.nda',$data);
    }
}
