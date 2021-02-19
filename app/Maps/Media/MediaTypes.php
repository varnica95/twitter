<?php

namespace App\Maps\Media;

class MediaTypes
{
    public static $image = [
        'image/jpg',
        'image/jpeg',
        'image/png',
    ];

    public static $video = [
        'video/mp4'
    ];

    public static function all()
    {
        return array_merge(self::$image, self::$video);
    }
}
