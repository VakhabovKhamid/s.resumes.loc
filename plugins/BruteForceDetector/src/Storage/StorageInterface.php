<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 30.07.18
 * Time: 9:33
 */

namespace BruteForceDetector\Storage;


interface StorageInterface
{
    public function read(string $key);

    public function write(string $key, $value);

    public function delete(string $key);

    public function setPrefix(string $prefix);

    public function getPrefix();
}