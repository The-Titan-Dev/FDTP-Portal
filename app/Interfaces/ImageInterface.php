<?php

namespace App\Interfaces;

interface ImageInterface
{
    public function loadAllImages();

    public function getSpecificImages($id);

    public function storeImages($data);

    public function updateImages($data, $id);

    public function deleteImages($id);
}