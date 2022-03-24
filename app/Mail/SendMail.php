<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $params;
    public function __construct($params)
    {
        //
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //echo 1;
        //dd($this->params['subject']);
        return $this->from(env('MAIL_USERNAME'), $this->params['name'] . ' - Francis Micko Bienes')
                    ->subject($this->params['subject'])
                    ->view('template.job_application')
                    ->with([
                        'position' => $this->params['position']
                    ]);
    }
}
