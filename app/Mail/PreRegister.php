<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreRegister extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    protected $to;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $to)
    {
        $this->content = $content;
        $this->to = $to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('mail.pre_register.' . $this->to)
            ->to($this->content['to'], $this->content['to_name'])
            ->from($this->content['from'], $this->content['from_name'])
            ->subject($this->content['subject'])
            ->with([
                'content' => $this->content,
            ]);
    }
}
