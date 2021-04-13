<?php


namespace App\Service;


use App\Models\Event;
use App\Models\Message;
use App\Models\Subscriber;

class PubSubService
{
    public function publish($event, $data)
    {
        return Message::create(['event_id' => $event->id, 'data' => json_encode($data)]);
    }

    public function subscribe($event, $webhook)
    {
        return Subscriber::firstOrCreate(
            ['webhook' => $webhook, 'event_id' => $event->id]
        );
    }
}
