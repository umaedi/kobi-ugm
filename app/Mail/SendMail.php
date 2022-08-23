<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pesan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pesan)
    {
        $this->pesan = $pesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kobi.biologi@gmail.com')->view('backend.email.email');
    }
}
