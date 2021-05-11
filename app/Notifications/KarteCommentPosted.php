<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Karte;

class KarteCommentPosted extends Notification
{
    use Queueable;

    /** @var Karte */
    protected $karte;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Karte $karte)
    {
        $this->karte = $karte;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'karte_id' => $this->karte->id
        ];
    }
}
