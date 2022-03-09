<?php namespace Visiosoft\NotificationsModule\Smsnotify\Event;


class StatusAdSms
{
    public function __construct($request,$msg)
    {
        $this->request = $request;
        $this->msg = $msg;
    }

    public function getRequest()
    {
        return $this;
    }
}
