<?php

namespace Zorb\Sender\Channels;

use Illuminate\Notifications\Notification;
use Zorb\Sender\Sender;

class SenderChannel
{
    /**
     * @param $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSender($notifiable);

        (new Sender())->send(
            $message->getRecipient(),
            $message->getContent()
        );
    }
}
