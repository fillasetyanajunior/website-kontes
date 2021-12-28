<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentValidationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $title,$id_transaksi,$totalcost,$email_transaksi;
    public function __construct($id_transaksi,$title,$totalcost,$email_transaksi)
    {
        $this->title = $title;
        $this->id_transaksi = $id_transaksi;
        $this->totalcost = $totalcost;
        $this->email_transaksi = $email_transaksi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.paymentvalidation');
    }
}
