<?php

namespace Zorb\Sender\Channels;

use Zorb\Sender\Sender;
use Illuminate\Notifications\Notification;

class SenderChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSender($notifiable);

        $response = (new Sender())->send(
            $message->getRecipient(),
            $message->getContent()
        );

        $callback = $message->getCallback();

        if ($callback instanceof \Closure) {
            $callback($response);
        }
    }
}
