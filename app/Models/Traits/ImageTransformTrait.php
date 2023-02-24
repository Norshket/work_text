<?php

namespace App\Models\Traits;

use Intervention\Image\Facades\Image;

trait ImageTransformTrait
{

    /**
     * @param string $path
     * @param int $width
     * @param int $height
     * @param int|null $x
     * @param int|null $y
     * 
     * @return [type]
     */
    function crop(string $path, int $width, int $height, int $x = null, int $y = null)
    {
        $img = Image::make($path);
        $img->crop($width, $height, $x, $y);
        $img->save($path);
    }
}
