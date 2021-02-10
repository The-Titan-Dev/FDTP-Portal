<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Models\Role;

class RoleRepository implements RoleInterface
{
    public function load()
    {
        return Role::all();
    }

    public function get($id)
    {
        return Role::find($id);
    }

    public function store($request)
    {
        $role = new Role;
        $role->system_id     = $request['system_id'];
        $role->role          = $request['role'];
        $role->description   = $request['description'];
        return $role->save();
    }

    public function update($id, $request)
    {
        $role = Role::find($id);
        $role->system_id     = $request['system_id'];
        $role->role          = $request['role'];
        $role->description   = $request['description'];
        return $role->save();
    }

    public function delete($id)
    {
        $result = false;

        $role = Role::destroy($id);

        if ($role) {
            $result = true;
        }
        
        return $result;
    }
}
