<?php

namespace Zorb\Sender;

use Illuminate\Support\Facades\Log;
use Zorb\Sender\Enums\MessageType;

class Sender
{
    //
    public function send(string $mobile, string $message, $type = MessageType::Information)
    {
        return $this->postRequest([
            'apikey' => config('sender.api_key'),
            'destination' => $mobile,
            'content' => $message,
            'smsno' => $type,
        ], 'send');
    }

    //
    public function report(int $messageId)
    {
        return $this->postRequest([
            'apikey' => config('sender.api_key'),
            'messageId' => $messageId
        ], 'callback');
    }

    //
    protected function postRequest(array $fields, string $method)
    {
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('sender.api_url') . "/{$method}.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);

        if (config('sender.debug')) {
            Log::debug($result);
            Log::debug($info);
        }

        curl_close($ch);

        return json_decode($result);
    }
}
