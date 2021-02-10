<?php

namespace App\Repositories;

use App\Interfaces\TokenInterface;
use App\Models\Token;
use Illuminate\Support\Str;

class TokenRepository implements TokenInterface
{
    public function loadAllToken()
    {
        return Token::all();
    }

    public function getSpecificToken($id)
    {
        return Token::find($id);
    }

    public function storeToken($request)
    {
        $Token = new Token;
        $Token->emp_id                   = $request['emp_id'];
        $Token->auth_token               =  Str::random(64);
        $Token->access_token_id          = $request['access_token_id'];
        $Token->save();
        $LastInsertId = $Token->emp_id;
        return $LastInsertId;
    }

    public function updateToken($id, $request)
    {
        $Token = Token::find($id);
        $Token->emp_id                   = $request['emp_id'];
        $Token->auth_token               =  Str::random(64);
        $Token->access_token_id          = $request['access_token_id'];
        return $Token->save();
    }

    public function deleteToken($id)
    {
        $result = false;
        
        $systems = Token::destroy($id);

        if ($systems) {
            $result = true;
        }
        return $result;
    }
}
