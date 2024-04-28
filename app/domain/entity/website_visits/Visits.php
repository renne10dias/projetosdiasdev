<?php

namespace app\domain\entity\website_visits;

use app\settings\libraries\uuid\UUIDGenerator;
date_default_timezone_set('America/Sao_Paulo');
class Visits{
    private string $uuid;
    private string $date;
    private string $browser;
    private string $ip;

    public function __construct(string $browser, string $ip){
        $uuidGenerator = new UUIDGenerator();
        $uuid = $uuidGenerator->getUUID();
        $this->uuid = $uuid;
        $this->date = date('Y-m-d H:i:s');
        $this->browser = $browser;
        $this->ip = $ip;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function getIp(): string
    {
        return $this->ip;
    }






}