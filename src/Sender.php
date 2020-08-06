<?php

namespace Zorb\Sender;

use Illuminate\Support\Facades\Log;
use Zorb\Sender\Enums\MessageType;

class Sender
{
    /**
     * Send message to recipient
     *
     * @param string $mobile
     * @param string $message
     * @param int $type
     * @return mixed
     */
    public function send(string $mobile, string $message, $type = MessageType::Information)
    {
        return $this->request([
            'apikey' => config('sender.api_key'),
            'destination' => $mobile,
            'content' => $message,
            'smsno' => $type,
        ], 'send');
    }

    /**
     * Check message status by message id
     *
     * @param int $message_id
     * @return mixed
     */
    public function status(int $message_id)
    {
        return $this->request([
            'apikey' => config('sender.api_key'),
            'messageId' => $message_id
        ], 'callback');
    }

    /**
     * Send post request of requested method
     *
     * @param array $params
     * @param string $method
     * @return mixed
     */
    protected function request(array $params, string $method)
    {
        $query_params = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('sender.api_url') . "/{$method}.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_params);
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
