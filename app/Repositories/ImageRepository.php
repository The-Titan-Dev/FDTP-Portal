<?php

namespace App\Repositories;

use App\Interfaces\ImageInterface;
use App\Models\Images;


class ImageRepository implements ImageInterface
{

    public function loadAllImages()
    {
        return Images::all();
    }

    public function getSpecificImages($id)
    {
        return Images::find($id);
    }

    public function storeImages($data)
    {
        $Images = new Images;
        $Images->system_id      = $data['system_id'];
        $Images->logo           = $data['logo'];
        $Images->main_image     = $data['main_image'];
        return $Images->save();
    }

    public function updateImages($data, $id)
    {
        $Images = Images::find($id);
        $Images->system_id      = $data['system_id'];
        $Images->logo           = $data['logo'];
        $Images->main_image     = $data['main_image'];
        return $Images->save();
    }

    public function deleteImages($id)
    {
        $result = false;
        
        $systems = Images::destroy($id);

        if ($systems) {
            $result = true;
        }
        return $result;
    }
}