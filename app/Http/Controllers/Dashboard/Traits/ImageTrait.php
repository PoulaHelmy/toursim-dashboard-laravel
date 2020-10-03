<?php

namespace App\Http\Controllers\Dashboard\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageTrait
{

    public function storeImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of Store

    public function delete_Image_From_Disk($image)
    {
        Storage::disk('public_uploads')->delete('/' . $image);
    }//End Of delete_Image_From_Disk


}//END OF TRAIT
