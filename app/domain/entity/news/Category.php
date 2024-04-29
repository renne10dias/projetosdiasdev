<?php

namespace app\domain\entity\news;

use app\settings\libraries\uuid\UUIDGenerator;

class Category{
    private string $uuid;
    private string $category_name;

    /**
     * @param string $category_name
     */
    public function __construct(string $category_name){
        $uuidGenerator = new UUIDGenerator();
        $uuid = $uuidGenerator->getUUID();
        $this->uuid = $uuid;
        $this->category_name = $category_name;
    }

    public function getUuid(): string{
        return $this->uuid;
    }

    public function getCategoryName(): string{
        return $this->category_name;
    }




}