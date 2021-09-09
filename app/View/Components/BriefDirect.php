<?php

namespace App\View\Components;

use App\Models\DetailProject;
use App\Models\JobCatagories;
use App\Models\Project;
use Illuminate\View\Component;

class BriefDirect extends Component
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
        $project = Project::where('id', $this->id)->first();
        $detail = DetailProject::where('project_id', $this->id)->first();
        $data['detaildirect'] = DetailProject::where('project_id', $this->id)->first();
        $data['jobdescription'] = JobCatagories::where('id', $detail->job_description)->first();
        return view('components.brief-direct',$data,compact('project'));
    }
}
