<?php

namespace app\domain\entity\news;

use app\domain\utils\FileUploader;
use app\domain\utils\FunctionServiceNews;
use app\settings\libraries\uuid\UUIDGenerator;
date_default_timezone_set('America/Sao_Paulo');

class News{
    private string $uuid;
    private string $title;
    private string $description;
    private string $text;
    private array $images;
    private string $slug;
    private string $link_share_news;
    private string $type;
    private string $created_at;
    private string $tb_category_uuid;
    private string $tb_user_uuid;


    public function __construct(string $title, string $description, string $text, array $images, string $type, string $tb_category_uuid, string $tb_user_uuid) {
        $uuidGenerator = new UUIDGenerator();
        $uuid = $uuidGenerator->getUUID();
        $this->uuid = $uuid;
        $this->title = $title;
        $this->description = $description;
        $this->text = $text;
        $this->images = $images;
        $this->slug = FunctionServiceNews::slugify($title);
        $this->link_share_news = 'link-share-news';
        $this->type = $type;
        $this->created_at = date('Y-m-d H:i:s');
        $this->tb_category_uuid = $tb_category_uuid;
        $this->tb_user_uuid = $tb_user_uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getLinkShareNews(): string
    {
        return $this->link_share_news;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getTbCategoryUuid(): string
    {
        return $this->tb_category_uuid;
    }

    public function getTbUserUuid(): string
    {
        return $this->tb_user_uuid;
    }




}