<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('iuranwarga@yahoo.com','Ketua RT')
        ->subject('Tagih Iuran')
        ->view('view-email')
        ->with(
         [
             'nama' => $this->data->first_name.' '.$this->data->last_name,
             'email' => $this->data->email,
         ]);
    }
}
