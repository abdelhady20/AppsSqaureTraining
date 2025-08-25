<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Banners\BannerRequest;
use App\Http\Requests\Api\Admin\Banners\BannerStoreRequest;
use App\Http\Requests\Api\Admin\Banners\BannerUpdateRequest;
use App\Services\Admin\Banner\BannerService;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function store(BannerStoreRequest $request)
    {
        $banner = $this->bannerService->create($request->validated());
        return response()->json($banner, 201);
    }

    public function update(BannerUpdateRequest $request, $id)
    {
        $banner = $this->bannerService->update($id, $request->validated());
        return response()->json($banner);
    }

    public function destroy($id)
    {
        $this->bannerService->delete($id);
        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
