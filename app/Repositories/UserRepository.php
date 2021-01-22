<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use App\Models\HrisSections;
use App\Models\HrisMasterlist;
use DB;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;


    public function load_sections()
    {
        return HrisSections::all('id', 'section', 'section_code');
    }

    public function load_hris_masterlist()
    {
        return HrisMasterlist::all();
    }

    public function get_user_from_hris($emp_id)
    {
        return HrisMasterlist::where('emp_pms_id', $emp_id)->first();
    }

    public function get_user_from_local($emp_id)
    {
        return User::where('emp_id', $emp_id)->first();
    }

    public function authenticate($credentials)
    {
        $result = [];
        if (Auth::once($credentials)) {
            $result['status'] = true;
            $result['user_data'] = Auth::user();
        } else {
            $result['status'] = false;
        }
        return $result;
    }
}
