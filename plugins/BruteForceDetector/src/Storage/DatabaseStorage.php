<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 08.08.18
 * Time: 16:20
 */

namespace BruteForceDetector\Storage;


use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;

class DatabaseStorage implements StorageInterface
{
    protected $Requests;

    protected $ip;

    protected $userAgent;

    protected $userHash;

    public function __construct(ServerRequest $request)
    {
        $this->userAgent = $request->getEnv('HTTP_USER_AGENT');

        $this->ip = $request->clientIp();

        $this->userHash = md5($this->ip . $this->userAgent);

        $this->Requests = TableRegistry::getTableLocator()->get('Requests');
    }


    public function read(string $key)
    {
        $data = $this->Requests
            ->find()
            ->select(['value'])
            ->where([
                'hash' => $this->userHash,
                'key' => $key
            ])
            ->first();

        if ($data) {
            return $data->value;
        }

        return false;
    }

    public function write(string $key, $value)
    {
        $request = $this->Requests
            ->find()
            ->where([
                'hash' => $this->userHash,
                'key' => $key
            ])
            ->first();

        if ($request) {
            $request->value = $value;
        } else {
            $request = $this->Requests->newEntity([
                'hash' => $this->userHash,
                'ip' => $this->ip,
                'user_agent' => $this->userAgent,
                'key' => $key,
                'value' => $value,
                'created' => new \DateTimeImmutable(),
                'modified' => new \DateTimeImmutable()
            ]);
        }

        $this->Requests->save($request);
    }

    public function delete(string $key)
    {
        $this->Requests->deleteAll([
            'hash' => $this->userHash,
            'key' => $key
        ]);
    }

    public function setPrefix(string $prefix)
    {
        // TODO: Implement setPrefix() method.
    }

    public function getPrefix()
    {
        // TODO: Implement getPrefix() method.
    }
}