<?php

namespace App\Interfaces;

interface ImageInterface
{
    public function load();

    public function get($id);

    public function store($request);

    public function update($id, $request);

    public function delete($id);
}
