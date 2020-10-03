<?php

namespace App\Http\Controllers\Dashboard\Traits;

use App\Models\Seo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait SeoTrait
{
    public function storeSeoImage($image, $width, $height)
    {
        return Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $image->hashName()));
    }//End Of storeSeoImage

    public function delete_Seo_Image_From_Disk($image)
    {
        Storage::disk('public_uploads')->delete('/' . $image);
    }//End Of delete_Seo_Image_From_Disk


    public function store_seo($request_array, $id, $nameSpace)
    {
        $request_array['seoable_id'] = $id;
        $request_array['seoable_type'] = $nameSpace;

        $og_ar_image = $this->storeSeoImage($request_array['ar']['og_image'], 300, null);
        $og_en_image = $this->storeSeoImage($request_array['en']['og_image'], 300, null);

        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;

        Seo::create($request_array);

    }//END OF update_seo

    public function update_seo($request_array, $model)
    {
        $seo = Seo::where('id', $model->seoAttributes['id'])->first();

        $this->delete_Seo_Image_From_Disk($seo->translate('ar')['og_image']);
        $this->delete_Seo_Image_From_Disk($seo->translate('en')['og_image']);

        $og_ar_image = $this->storeSeoImage($request_array['ar']['og_image'], 300, null);
        $og_en_image = $this->storeSeoImage($request_array['en']['og_image'], 300, null);

        $request_array['ar']['og_image'] = $og_ar_image->filename . '.' . $og_ar_image->extension;
        $request_array['en']['og_image'] = $og_en_image->filename . '.' . $og_en_image->extension;

        $seo->update($request_array);

    }//END OF update_seo


    public function delete_seo($model)
    {
        $seo = Seo::where('id', $model->seoAttributes['id'])->first();

        $this->delete_Seo_Image_From_Disk($seo->translate('ar')['og_image']);
        $this->delete_Seo_Image_From_Disk($seo->translate('en')['og_image']);

        $seo->delete();
    }//END OF delete_seo


}//END OF TRAIT
