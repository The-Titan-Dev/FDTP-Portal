<?php

namespace App\Repositories;

use App\Interfaces\ImageInterface;
use App\Models\Image;

class ImageRepository implements ImageInterface
{
    public function load()
    {
        return Image::all();
    }

    public function get($id)
    {
        return Image::find($id);
    }

    public function store($request)
    {
        return Image::create($request);
    }

    public function update($id, $request)
    {
        return 'NO UPDATE YET';
        // $data = Image::find($id);
        // $data->system_id     = $request['system_id'];
        // $data->logo          = $request['logo'];
        // $data->main_image    = $request['main_image'];
        // $data->images        = $request['images'];
        // return $data->save();
    }

    public function delete($id)
    {
        $result = false;

        $data = Image::destroy($id);

        if ($data) {
            $result = true;
        }

        return $result;
    }
}
