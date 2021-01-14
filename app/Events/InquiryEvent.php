<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Inquiry;

class InquiryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User */
    protected $user;
    /** @var Inquiry */
    protected $inquiry;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Inquiry $inquiry)
    {
        $this->user = $user;
        $this->inquiry = $inquiry;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user-' . $this->user->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $this->inquiry->data += ['meta' => (new Carbon($this->inquiry->created_at))->format('H時i分')];
        return $this->inquiry->toArray();
    }
}
