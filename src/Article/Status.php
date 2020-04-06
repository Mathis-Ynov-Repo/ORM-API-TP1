<?php 
namespace App\Article;

class Status
{
    const UNPUBLISHED = 0;
    const WRITING = 1;
    const PUBLISHED = 2;

    public static function getStatus() {
        return [
            self::UNPUBLISHED,
            self::WRITING,
            self::PUBLISHED
        ];
    }
}
