<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Gallary;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait GallaryTrait
{
    public function storeGallaryImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of storeSeoImage

    public function delete_Gallary_Image_From_Disk($image)
    {
        Storage::disk('public_uploads')->delete('/' . $image);
    }//End Of delete_Seo_Image_From_Disk


    public function store_gallary($slider, $id, $nameSpace)
    {
        foreach ($slider as $image) {
            $photo = $this->storeGallaryImage($image, 300, null);
            Gallary::create([
                'url' => $photo->filename . '.' . $photo->extension,
                'alt' => 'abcddsdasda',
                'gallarable_id' => $id,
                'gallarable_type' => $nameSpace
            ]);
        }

    }//END OF update_seo

    public function update_gallary($existing_gallary, $new_gallary, $id, $nameSpace)
    {
        //DELETE IMAGES FROM DISK
        $this->delete_gallary($existing_gallary);
        $this->store_gallary($new_gallary, $id, $nameSpace);

    }//END OF update_seo


    public function delete_gallary($gallary)
    {
        foreach ($gallary as $img) {
            // DELETE IMAGE FROM DISK
            $this->delete_Gallary_Image_From_Disk($img->url);
            //DELETE IMAGE FROM DATA BASE
            $img->delete();
        }
    }//END OF delete_seo


}//END OF TRAIT
