<?php

namespace App\View\Components;

use App\Models\MessageComentar;
use App\Models\Project;
use App\Models\ResultContest;
use Illuminate\View\Component;

class GalleryContest extends Component
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
        $project            = Project::where('id',$this->id)->first();
        $data['message']    = MessageComentar::where('result_id', $project->id)->get();
        if (request()->user()->role == 'customer' || request()->user()->role == 'admin') {
            $data['resultcontest'] = ResultContest::orderBy('is_active','DESC')->where('contest_id', $project->id)->get();
        } else {
            if ($project->is_active == 'running') {
                $data['resultcontest'] = ResultContest::orderBy('is_active','DESC')->where('contest_id', $project->id)->where('user_id_worker', request()->user()->id)->get();
            } else {
                $data['resultcontest'] = ResultContest::orderBy('is_active','DESC')->where('contest_id', $project->id)->get();
            }
        }
        return view('components.gallery-contest',$data,compact('project'));
    }
}
