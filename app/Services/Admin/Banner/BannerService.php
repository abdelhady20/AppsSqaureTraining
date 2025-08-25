<?php

namespace App\Services\Admin\Banner;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerService
{

    public function create(array $data)
    {
        if (isset($data['image']) && is_file($data['image'])) {
            $path = $data['image']->store('banners', 'public');
            $data['image'] = $path;
        }
        return Banner::create($data);
    }

    public function update($id, array $data)
    {
        $banner = Banner::findOrFail($id);

        if (isset($data['image']) && is_file($data['image'])) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $path = $data['image']->store('banners', 'public');
            $data['image'] = $path;
        }

        $banner->update($data);
        return $banner;
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        return $banner->delete();
    }
}
