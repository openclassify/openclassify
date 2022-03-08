<?php namespace Visiosoft\NotificationsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;

class SmsnotifyController extends AdminController
{

    public function test()
    {
        $msg = "test";
        $user = auth()->user();
        $netgsmcontroller = app(\Visiosoft\NetgsmModule\Http\Controller\NetgsmController::class);
        $netgsmcontroller->netGSMListenerSend($msg, $user);
        $kanyonsmscontroller = app(\Visiosoft\KanyonsmsModule\Http\Controller\KanyonSmsController::class);
        $kanyonsmscontroller->KanyonSmsListenerSend($msg, $user);
    }
}
