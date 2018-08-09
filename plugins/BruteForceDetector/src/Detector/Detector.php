<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 30.07.18
 * Time: 9:58
 */

namespace BruteForceDetector\Detector;


use BruteForceDetector\Storage\StorageInterface;

abstract class Detector
{
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public abstract function isBruteForce() : bool;
}