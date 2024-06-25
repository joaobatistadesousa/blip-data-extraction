<?php

namespace App\Console;

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SentMessageController;
use App\Http\Controllers\ClientsPlanDausController;
use App\Http\Controllers\ReceivedMessageController;
use App\Http\Controllers\EventDetailsController;
use Illuminate\Http\Request;

Schedule::call(function () {
   
    $sentMessageController =new  SentMessageController();
    $sentMessageController->store();
})->weekdays()->at('09:00');

Schedule::call(function () {
   
    $clientsPlanDausController =new  ClientsPlanDausController();

    $clientsPlanDausController->store();
})->weekdays()->at('10:00');

Schedule::call(function () {
   
    $receivedMessageController =new  ReceivedMessageController();
    $receivedMessageController->store();
})->weekdays()->at('11:00');

Schedule::call(function () {
    $bot1Key = 'Key dmVyYXRlc3RlOmNSSHY2REtlWXQ3bXBjWkZURmRw';
    $eventName = ['flow','Férias'];

    $eventDetailsController = new EventDetailsController();
    $result = $eventDetailsController->storeEspecific($bot1Key, $eventName);

    if (is_array($result) && isset($result['error'])) {
        \Log::error($result['error']);
    } else {
        \Log::info($result);
    }
})->weekdays()->at('12:00');





Schedule::call(function () {
    $bot1Key ='Key dHVyYm9uZXRtaW5hc3JvdXRlcjpsTFRSeXoxNTllYklGVmVueHk3Ug==';
    $eventName = ['Redirect'];

    $eventDetailsController = new EventDetailsController();
    $result = $eventDetailsController->storeEspecific($bot1Key, $eventName);

    if (is_array($result) && isset($result['error'])) {
        \Log::error($result['error']);
    } else {
        \Log::info($result);
    }
})->weekdays()->at('11:46');

//super brilho
Schedule::call(function () {
    $bot1Key = 'Key cm90ZWFkb3JzdXBlcmJyaWxobzpWUjZaUGUyb1ZUYmN6ZmdlWXBVdA==';
    $eventName = ['flow','Setor','AtendimentosTotais','Fiscal','Redirect'];

    $eventDetailsController = new EventDetailsController();
    $result = $eventDetailsController->storeEspecific($bot1Key, $eventName);

    if (is_array($result) && isset($result['error'])) {
        \Log::error($result['error']);
    } else {
        \Log::info($result);
    }
})->weekdays()->at('13:00');

