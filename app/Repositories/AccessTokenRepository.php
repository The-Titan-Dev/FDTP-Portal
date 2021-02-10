<?php

namespace App\Repositories;

use App\Interfaces\AccessTokenInterface;
use App\Models\AccessToken;
use Illuminate\Support\Str;

class AccessTokenRepository implements AccessTokenInterface
{
    public function loadAllAccessToken()
    {
        return AccessToken::all();
    }

    public function getSpecificAccessToken($id)
    {
        return AccessToken::find($id);
    }

    public function storeAccessToken($request)
    {
        $Token = new AccessToken;
        $Token->access_token                =  Str::random(64);
        $Token->system_id                   = $request['system_id'];
        return $Token->save();
    }

    public function updateAccessToken($id, $request)
    {
        $Token = AccessToken::find($id);
        $Token->access_token                =  Str::random(64);
        $Token->system_id                   =  $request['system_id'];
        return $Token->save();
    }

    public function deleteAccessToken($id)
    {
        $result = false;
        
        $systems = AccessToken::destroy($id);

        if ($systems) {
            $result = true;
        }
        return $result;
    }
}
