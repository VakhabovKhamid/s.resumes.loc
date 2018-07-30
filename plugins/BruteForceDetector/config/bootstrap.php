<?php

use BruteForceDetector\Middleware\TrackingRequestAttemptsMiddleware;
use Cake\Event\EventManager;

EventManager::instance()->on(
    'Server.buildMiddleware',
    function ($event, $middlewareQueue) {
        $middlewareQueue->add(new TrackingRequestAttemptsMiddleware());
    });