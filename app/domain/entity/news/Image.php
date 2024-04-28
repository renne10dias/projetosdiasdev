<?php

namespace app\domain\entity\news;

class Image{
    private string $uuid;
    private string $name;
    private string $path;
    private string $date_upload;
    private string $tb_news_uuid;


    public function __construct(string $uuid, string $name, string $path, string $date_upload, string $tb_news_uuid){
        $this->uuid = $uuid;
        $this->name = $name;
        $this->path = $path;
        $this->date_upload = $date_upload;
        $this->tb_news_uuid = $tb_news_uuid;
    }


}