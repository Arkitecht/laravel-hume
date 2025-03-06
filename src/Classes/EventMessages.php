<?php

namespace Arkitecht\LaravelHume\Classes;

class EventMessages extends AbstractClass
{
    protected OnNewChat $onNewChat;

    protected OnResumeChat $onResumeChat;
    protected OnDisconnectResumeChat $onDisconnectResumeChat;
    protected OnInactivityTimeout $onInactivityTimeout;
    protected OnMaxDurationTimeout $onMaxDurationTimeout;

}
