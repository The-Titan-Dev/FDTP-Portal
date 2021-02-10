<?php

namespace App\Interfaces;

use App\Http\Requests\AccessTokenRequest;

interface AccessTokenInterface
{
    public function loadAllAccessToken();

    public function getSpecificAccessToken($id);

    public function storeAccessToken($request);

    public function updateAccessToken($id, $request);

    public function deleteAccessToken($id);

}
