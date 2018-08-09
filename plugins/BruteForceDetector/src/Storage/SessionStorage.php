<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 30.07.18
 * Time: 9:47
 */

namespace BruteForceDetector\Storage;


use Cake\Http\Session;

class SessionStorage implements StorageInterface
{
    private $session;
    private $prefix = 'BFD';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function read(string $key)
    {
        $data = $this->session->read($this->prefix);
        if(!isset($data[$key])) {
            return null;
        }
        return $data[$key];
    }

    public function write(string $key, $value)
    {
        $data = $this->session->read($this->prefix);
        $data[$key] = $value;
        $this->session->write($this->prefix, $data);
    }

    public function delete(string $key)
    {
        $data = $this->session->read($this->prefix);
        unset($data[$key]);
        $this->session->write($this->prefix, $data);
    }

    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }
}