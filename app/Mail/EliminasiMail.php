<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\ResultContest;
use App\Models\ResultProject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EliminasiMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $eliminasi,$project,$role;
    public function __construct($id,$role)
    {
        $project        = Project::where('id', $id)->first();
        $this->project  = $project;
        $this->role     = $role;
        if ($project->catagories_project == 'contest') {
            $this->eliminasi = ResultContest::where('contest_id',$id)->first();
        } else {
            $this->eliminasi = ResultProject::where('contest_id',$id)->first();
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.eliminasi');
    }
}
