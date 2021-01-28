<?php

namespace App\Repositories;

use App\Interfaces\SystemRestrictionInterface;
use App\Models\SystemRestriction;

class SystemRestrictionRepository implements SystemRestrictionInterface
{
    public function load()
    {
        return SystemRestriction::all();
    }

    public function get($id)
    {
        return SystemRestriction::find($id);
    }

    public function store($request)
    {
        $role = new SystemRestriction();
        $role->system_access_id    = $request['system_access_id'];
        $role->role_id             = $request['role_id'];
        return $role->save();
    }

    public function update($id, $request)
    {
        $role = SystemRestriction::find($id);
        $role->system_access_id    = $request['system_access_id'];
        $role->role_id             = $request['role_id'];
        return $role->save();
    }

    public function delete($id)
    {
        $result = false;

        $role = SystemRestriction::destroy($id);

        if ($role) {
            $result = true;
        }
        
        return $result;
    }
}
