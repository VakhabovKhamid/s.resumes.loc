<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 30.07.18
 * Time: 10:02
 */

namespace BruteForceDetector\Detector;


use BruteForceDetector\Storage\SessionStorage;
use BruteForceDetector\Storage\StorageInterface;
use Cake\I18n\Time;
use Cake\Network\Request;

class BruteForceByActionDetector extends Detector
{
    private $requestActionTimeLimit = '+1 mins';
    private $longTimeLimit = '+10 mins';
    private $requestActionAttemptsLimit = 500;

    private $controller;
    private $action;

    private $lastRequestTime;
    private $requestActionAttempts;

    private $lastRequestTimeKey;
    private $requestActionAttemptsKey;

    public function __construct(Request $request, StorageInterface $storage)
    {
        $storage->setPrefix('BruteForceDetector');
        parent::__construct($storage);


        $this->controller = $request->getParam('controller');
        $this->action = $request->getParam('action');

        $this->init();
        $this->calcRequestActionAttempts();
        $this->updateLastRequestTime();
    }

    public function isBruteForce(): bool
    {
        return $this->requestActionAttempts > $this->requestActionAttemptsLimit;
    }

    private function init()
    {
        $this->lastRequestTimeKey = "{$this->controller}{$this->action}LastRequestTime";
        $this->requestActionAttemptsKey = "{$this->controller}{$this->action}RequestActionAttempts";

        $this->setLastRequestTime();
        $this->setRequestActionAttempts();

    }

    private function setLastRequestTime()
    {
        $this->lastRequestTime = $this->storage->read($this->lastRequestTimeKey);
        if (!$this->lastRequestTime) {
            $this->lastRequestTime = Time::now();
            $this->storage->write($this->lastRequestTimeKey, $this->lastRequestTime);
        }
    }

    private function setRequestActionAttempts()
    {
        $this->requestActionAttempts = $this->storage->read($this->requestActionAttemptsKey);
        if (!$this->requestActionAttempts) {
            $this->requestActionAttempts = 0;
            $this->storage->write($this->requestActionAttemptsKey, $this->requestActionAttempts);
        }
    }

    private function calcRequestActionAttempts()
    {
        if ($this->isRequestAfterLongTimeLimit()) {
           $this->resetRequestActionAttempts();
           return;
        }

        if ($this->isRequestInForbiddenTime()) {
            $this->incrementRequestActionAttempts();
        }
    }

    private function isRequestAfterLongTimeLimit()
    {
        $now = Time::now()->getTimestamp();
        $longTimeLimit = clone $this->lastRequestTime;
        $longTimeLimit = $longTimeLimit->modify($this->longTimeLimit)->getTimestamp();

        return $longTimeLimit <= $now;
    }

    private function resetRequestActionAttempts()
    {
        $this->requestActionAttempts = 0;
        $this->storage->write($this->requestActionAttemptsKey, $this->requestActionAttempts);
    }

    private function isRequestInForbiddenTime()
    {
        $now = Time::now()->getTimestamp();
        $forbiddenForRequestTime = clone $this->lastRequestTime;
        $forbiddenForRequestTime = $forbiddenForRequestTime->modify($this->requestActionTimeLimit)->getTimestamp();

        return $forbiddenForRequestTime >= $now;
    }

    private function incrementRequestActionAttempts()
    {
        $this->requestActionAttempts += 1;
        $this->storage->write($this->requestActionAttemptsKey, $this->requestActionAttempts);
    }

    private function updateLastRequestTime()
    {
        $this->lastRequestTime = Time::now();
        $this->storage->write($this->lastRequestTimeKey, $this->lastRequestTime);
    }


    // SETUP LIMITS ----------------------------------------------------------------------------

    /**
     * @param string $requestActionTimeLimit
     */
    public function setRequestActionTimeLimit(string $requestActionTimeLimit)
    {
        $this->requestActionTimeLimit = $requestActionTimeLimit;
    }

    /**
     * @param int $requestActionAttemptsLimit
     */
    public function setRequestActionAttemptsLimit(int $requestActionAttemptsLimit)
    {
        $this->requestActionAttemptsLimit = $requestActionAttemptsLimit;
    }

    /**
     * @param string $longTimeLimit
     */
    public function setLongTimeLimit(string $longTimeLimit)
    {
        $this->longTimeLimit = $longTimeLimit;
    }


}