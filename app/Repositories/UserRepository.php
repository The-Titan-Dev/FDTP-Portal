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
        try {
            $sections = HrisSections::all('id', 'section', 'section_code');
            return $this->success("Sections Loaded", $sections);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function load_hris_masterlist()
    {
        try {
            $masterlist = HrisMasterlist::all();
            return $this->success("HRIS Masterlist loaded", $masterlist);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function get_user_from_hris($emp_id)
    {
        try {
            $user_data = HrisMasterlist::where('emp_pms_id', $emp_id)->first();
            return $this->success('User data retrived from hris', $user_data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function get_user_from_local($emp_id)
    {
        try {
            $user_data = User::where('emp_id', $emp_id)->first();
            return $this->success("User data retrieved from local data", $user_data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function authenticate($credentials)
    {
        try {
            $result = [];
            if (Auth::once($credentials)) {
                $result['status'] = true;
                $result['user_data'] = Auth::user();
            } else {
                $result['status'] = false;
            }
            return $result;
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
