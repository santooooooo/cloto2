<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Comment;
use App\Models\User;

class CommentFavorited extends Notification
{
    use Queueable;

    /** @var Comment */
    protected $comment;
    /** @var User */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $user)
    {
        $this->comment = $comment;
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
        $data = ['user_id' => $this->user->id];

        if (!empty($this->comment->karte)) {
            $data += ['karte_id' => $this->comment->karte->id];
        } else if (!empty($this->comment->post)) {
            $data += ['post_id' => $this->comment->post->id];
        }

        return $data;
    }
}
