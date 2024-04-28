<?php

namespace app\domain\entity\news;

class Category{
    private string $uuid;
    private string $category;


    public function __construct(string $uuid, string $category)
    {
        $this->uuid = $uuid;
        $this->category = $category;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCategory(): string
    {
        return $this->category;
    }


}