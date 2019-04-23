<?php

namespace App\Events;


use App\Models\Comments\Comment;
use App\Models\Users\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewComment implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn()
    {
        return new privateChannel('comment.' . $this->comment->commentable_id);
    }

    public function broadcastWith()
    {
        return [
            'comment' => $this->comment->body,
            'date' => $this->comment->created_at,
            'commentid' => $this->comment->id,
            'name' => $this->comment->user->name,
        ];
    }


}
