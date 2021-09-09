<?php

namespace App\View\Components;

use App\Models\Catagories;
use App\Models\DetailContest;
use App\Models\OpsiPackage;
use App\Models\OpsiPackageUpgrade;
use App\Models\Project;
use App\Models\SubCatagories;
use Illuminate\View\Component;

class BriefContest extends Component
{
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $project                = Project::where('id', $this->id)->first();
        $detail                 = DetailContest::where('project_id', $this->id)->first();
        $data['detailcontest']  = DetailContest::where('project_id', $this->id)->first();
        $data['catagories']     = Catagories::where('id', $detail->catagories)->first();
        $data['subcatagories']  = SubCatagories::where('id', $detail->subcatagories)->first();
        $data['opsi']           = OpsiPackage::where('id', $detail->package)->first();
        if ($detail->packageupgrade != null) {
            $data['opsiupgrade'] = OpsiPackageUpgrade::where('id', $detail->packageupgrade)->first();
        }
        return view('components.brief-contest',compact('project'),$data);
    }
}
