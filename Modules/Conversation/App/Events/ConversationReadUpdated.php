<?php

namespace Modules\Conversation\App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversationReadUpdated implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public int $userId,
        public array $payload,
    ) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('users.'.$this->userId.'.inbox');
    }

    public function broadcastAs(): string
    {
        return 'inbox.read.updated';
    }

    public function broadcastWith(): array
    {
        return $this->payload;
    }
}
