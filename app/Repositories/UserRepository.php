<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\Contacts;
use App\Models\User;
use App\Models\HrisSections;
use App\Models\HrisMasterlist;
use App\Models\Images;
use App\Models\Role;
use App\Models\RoleAccess;
use App\Models\SystemAccess;
use App\Models\Systems;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
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
        if (Auth::attempt($credentials)) 
        {
            $empid = Auth::user()->emp_id;
            $result['status'] = true;
            $result['user_info'] = Auth::user();
            $result['user_token'] = $this->gettokens($empid);

            $result['user_system_access'] = $this->getsystemAccess($empid);
            $systemid = $result['user_system_access'];

            if(count($systemid) > 0 )
            {
                foreach ($systemid as $value) {
                    $system_id[] = $value->id;
                };
                $result['user_system'] = $this->getsystem($system_id);
                $result['user_system_role'] = $this->getsystemRoles($system_id);
                $roleid = $result['user_system_role'];
                foreach ($roleid as $value) {
                    $role_id[] = $value->id;
                };
                $result['user_role_access'] = $this->getRoleAccess($system_id, $role_id);
                $result['user_system_contacts'] = $this->getuserContacts($empid);
                $result['system_images'] = $this->getsystemimages($system_id);
            }   
        } 
        else 
        {
            $result['status'] = false;
        }
        return $result;
    }

    public function registeredUser($data)
    {
        return User::create($data);
    }

    public function gettokens($emp_id)
    {
        return Token::where('emp_id',$emp_id)
                    ->leftjoin('access_tokens as a','tokens.access_token_id','=','a.id')
                    ->first();
    }

    public function getsystemAccess($emp_id)
    {
        return SystemAccess::where('emp_id',$emp_id)
                    ->get();
    }

    public function getsystem($id_in)
    {
        return Systems::whereIn('id',$id_in)
                    ->get();
    }

    public function getsystemRoles($id)
    {
        return Role::whereIn('system_id',$id)
                    ->get();  
    }

    public function getRoleAccess($system_id, $role_id)
    {
        return RoleAccess::whereIn('system_access_id',$system_id)
                    ->whereIn('role_id',$role_id)
                    ->get();  
    }

    public function getuserContacts($emp_id)
    {
        return Contacts::where('emp_id',$emp_id)
                    ->first();
    }

    public function getsystemimages($system_id)
    {
        return Images::whereIn('system_id',$system_id)
                    ->get();
    }
}
