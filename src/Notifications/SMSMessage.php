<?php

namespace Zorb\Sender\Notifications;

class SMSMessage
{
    /**
     * @var string
     */
    private $_recipient;

    /**
     * @var string
     */
    private $_content;

    /**
     * @var \Closure
     */
    private $_callback;

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->_recipient;
    }

    /**
     * @param string $recipient
     * @return $this
     */
    public function recipient(string $recipient): SMSMessage
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function content(string $content): SMSMessage
    {
        $this->_content = $content;
        return $this;
    }

    /**
     * @return \Closure
     */
    public function getCallback(): \Closure
    {
        return $this->_callback;
    }

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function callback(\Closure $callback): SMSMessage
    {
        $this->_callback = $callback;
        return $this;
    }
}
