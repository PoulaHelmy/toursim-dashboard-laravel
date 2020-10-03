<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait PhotosTrait
{
    public function storePhotosImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of storeSeoImage

    public function delete_Photos_Image_From_Disk($image)
    {
        Storage::disk('public_uploads')->delete('/' . $image);
    }//End Of delete_Seo_Image_From_Disk

    public function store_photos($request_array, $id, $nameSpace)
    {

        $bannerImage = $this->storePhotosImage($request_array['banner_url'], 300, null);
        $thumbImage = $this->storePhotosImage($request_array['thumb_url'], 150, 150);

        Photo::create([
            'banner_url' => $bannerImage->filename . '.' . $bannerImage->extension,
            'thumb_url' => $thumbImage->filename . '.' . $thumbImage->extension,
            'banner_alt' => $request_array['banner_alt'],
            'thumb_alt' => $request_array['thumb_alt'],
            'photoable_id' => $id,
            'photoable_type' => $nameSpace,
        ]);
    }//END OF store_photos

    public function update_photos($request_array, $model)
    {
        $photos = Photo::where('id', $model->photos['id'])->first();

        $this->delete_Photos_Image_From_Disk($photos->banner_url);
        $this->delete_Photos_Image_From_Disk($photos->thumb_url);

        $bannerImage = $this->storePhotosImage($request_array['banner_url'], 300, null);
        $thumbImage = $this->storePhotosImage($request_array['thumb_url'], 150, 150);

        $request_array['banner_url'] = $bannerImage->filename . '.' . $bannerImage->extension;
        $request_array['thumb_url'] = $thumbImage->filename . '.' . $thumbImage->extension;

        $photos->update($request_array);
    }//END OF update_photos


    public function delete_photos($model)
    {
        $photos = Photo::where('id', $model->photos['id'])->first();

        $this->delete_Photos_Image_From_Disk($photos->banner_url);
        $this->delete_Photos_Image_From_Disk($photos->thumb_url);

        $photos->delete();
    }//END OF delete_photos


}//END OF TRAIT
