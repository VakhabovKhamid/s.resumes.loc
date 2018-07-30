<?php

namespace Config\Helpers;
use Phinx\Seed\AbstractSeed;

class SeederHelper{
    public static function applyTimestampts($data){
        return array_map('self::setTimestampts',$data);
    }

    public static function setTimestampts($item){
        $currentDateTime = (new \DateTime())->format('Y-m-d H:i:s');
        $item['created'] = $currentDateTime;
        $item['modified'] = $currentDateTime;
        return $item;
    }

    public static function dd($data){
        var_dump($data);
        die();
    }

    public static function clear(AbstractSeed $seed, string $tableName ): int{
        $affected = $seed->execute("DELETE FROM $tableName");
        return $affected;
    }

    public static function fromJson($rawJson){
        return json_decode($rawJson,true);
    }

    public static function defaultPrepare($data){
        return self::applyTimestampts( 
            self::fromJson($data) 
        );
    }
}