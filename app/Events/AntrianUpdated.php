<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class AntrianUpdated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;
    public function __construct($data) { $this->data = $data; }
    public function broadcastOn(): array { return [new Channel('antrian')]; }
    public function broadcastAs(): string { return 'antrian.updated'; }
}