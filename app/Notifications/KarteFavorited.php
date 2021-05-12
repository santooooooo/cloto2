<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Karte;
use App\Models\User;

class KarteFavorited extends Notification
{
    use Queueable;

    /** @var Karte */
    protected $karte;
    /** @var User */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Karte $karte, User $user)
    {
        $this->karte = $karte;
        $this->user = $user;
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
            'karte_id' => $this->karte->id,
            'user_id' => $this->user->id
        ];
    }
}
