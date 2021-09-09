<?php

namespace App\Mail;

use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id,$id_report;
    public function __construct($id,$id_report)
    {
        $this->id = $id;
        $this->id_report = $id_report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from_email = User::where('id', $this->id_report)->first();
        return $this->from($from_email->email, $from_email->name)->view('mail.report');
    }
}
