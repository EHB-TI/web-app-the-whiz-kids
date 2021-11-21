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
    public function __construct($email, $data)
    {
        $this->fromEmail = $email;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data->type == "contact") {
            return $this->from($this->fromEmail)->replyTo($this->fromEmail, $this->data->name)->subject('New Contact Site')->view('mail.dynamic_template_contact')->with('data', $this->data);
        } elseif ($this->data->type == "usercreate") {
            return $this->from($this->fromEmail)->replyTo($this->fromEmail, $this->data->name)->subject('Account created')->view('mail.dynamic_template_usercreate')->with('data', $this->data);
        }
    }
}
