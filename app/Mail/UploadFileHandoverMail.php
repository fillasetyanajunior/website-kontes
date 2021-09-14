<?php

namespace App\Mail;

use App\Models\UploadFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UploadFileHandoverMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $uploadfile,$project;
    public function __construct($id_project,$project)
    {
        $this->project = $project;
        $this->uploadfile = UploadFile::where('contest_id_winner',$id_project)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.uploadfile');
    }
}
