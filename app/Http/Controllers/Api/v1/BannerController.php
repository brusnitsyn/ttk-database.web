<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\UploadImage;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BannerResource::collection(Banner::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'header' => ['string', 'max:380'],
            'image' => ['image'],
            'url' => ['string', 'max:380'],
        ]);

        $banner = new Banner;
        $banner->header = $request->header;
        $banner->url = $request->url;
        $banner->save();

        $image = $request->image;
        $imageName = uniqid() . '_' . str_replace(' ', '_', $image->getClientOriginalName());

        $host = $request->getSchemeAndHttpHost();

        $uploadImage = new UploadImage;
        $uploadImage->name = $imageName;
        $uploadImage->url = $host . '/storage/' . $uploadImage->upload($image, 'public', 'banners');

        $banner->image()->save($uploadImage);

        return BannerResource::make($banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $image = $banner->image();
        if ($image)
            $image->delete();
        $banner->delete();
    }
}
