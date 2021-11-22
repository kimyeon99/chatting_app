<?php

namespace App\Events;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use SebastianBergmann\Environment\Console;

class RoomMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $room;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //presense 채널로 바꾸기
        // return new PrivateChannel('chat.'.$this->room->id);
        return new PresenceChannel('chat.'.$this->room->id);

        # 'chat.'.$this->room->id 이라는 채널에 브로드캐스팅을 한다. 여기서 뭘 넘겨주느냐는 문서에서 넘겨주는 메소드를 보고 넘겨라
        # 넘기면 이 데이터와 함께 저 채널에 브로드캐스트를 한다. 
        # 주의 
        # 위에서 또 메소드로 어떤 이벤트를 발생시킬건지 정의를 한다. 문서(브로드캐스트 이름)
    }

    public function broadcastWith()
    {
        return ["ChannelMessage" => "broadcastWith"];
    }
}
