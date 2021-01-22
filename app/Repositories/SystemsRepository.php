<?php

namespace App\Repositories;

use App\Interfaces\SystemsInterface;
use App\Traits\ResponseAPI;
use App\Models\Systems;

class SystemsRepository implements SystemsInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function load()
    {
        $sections = Systems::all();
        return $this->success("Systems Loaded", $sections);
    }
}
