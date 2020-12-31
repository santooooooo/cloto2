<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Array */
    protected $content;
    /** @var String */
    protected $direction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $content, String $direction)
    {
        $this->content = $content;
        $this->direction = $direction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('mail.contact.' . $this->direction)
            ->to($this->content['to'], $this->content['to_name'])
            ->from($this->content['from'], $this->content['from_name'])
            ->subject($this->content['subject'])
            ->with([
                'content' => $this->content,
            ]);
    }
}
