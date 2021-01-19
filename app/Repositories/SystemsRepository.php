<?php

namespace App\Repositories;

use App\Interfaces\SystemsInterface;
use App\Traits\ResponseAPI;
use DB;
use Illuminate\Support\Facades\Auth;

class SystemsRepository implements SystemsInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function load()
    {
        try{

        }catch(\Exception $e){
            
        }
    }
}