<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Maps\Media\MediaTypes;
use Illuminate\Http\Request;

class MediaTypesController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'image' => MediaTypes::$image,
                'video' => MediaTypes::$video,
            ]
        ]);
    }
}
