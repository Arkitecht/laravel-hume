<?php

namespace Arkitecht\LaravelHume\Classes;

class EventMessages extends AbstractClass
{
    protected OnNewChat $onNewChat;
    protected OnResumeChat $onResumeChat;
    protected OnDisconnectResumeChat $onDisconnectResumeChat;
    protected OnInactivityTimeout $onInactivityTimeout;
    protected OnMaxDurationTimeout $onMaxDurationTimeout;

    public function getOnNewChat(): OnNewChat
    {
        return $this->onNewChat;
    }

    public function setOnNewChat(OnNewChat $onNewChat)
    {
        $this->onNewChat = $onNewChat;
        return $this;
    }

    public function getOnResumeChat(): OnResumeChat
    {
        return $this->onResumeChat;
    }

    public function setOnResumeChat(OnResumeChat $onResumeChat)
    {
        $this->onResumeChat = $onResumeChat;
        return $this;
    }

    public function getOnDisconnectResumeChat(): OnDisconnectResumeChat
    {
        return $this->onDisconnectResumeChat;
    }

    public function setOnDisconnectResumeChat(OnDisconnectResumeChat $onDisconnectResumeChat)
    {
        $this->onDisconnectResumeChat = $onDisconnectResumeChat;
        return $this;
    }

    public function getOnInactivityTimeout(): OnInactivityTimeout
    {
        return $this->onInactivityTimeout;
    }

    public function setOnInactivityTimeout(OnInactivityTimeout $onInactivityTimeout)
    {
        $this->onInactivityTimeout = $onInactivityTimeout;
        return $this;
    }

    public function getOnMaxDurationTimeout(): OnMaxDurationTimeout
    {
        return $this->onMaxDurationTimeout;
    }

    public function setOnMaxDurationTimeout(OnMaxDurationTimeout $onMaxDurationTimeout)
    {
        $this->onMaxDurationTimeout = $onMaxDurationTimeout;
        return $this;
    }
}
