<?php

namespace App\Repositories;

use App\Interfaces\RoleAccessInterface;
use App\Models\RoleAccess;

class RoleAccessRepository implements RoleAccessInterface
{
    public function loadAllRoleAccess()
    {
        return RoleAccess::all();
    }

    public function getSpecificRoleAccess($id)
    {
        return RoleAccess::find($id);
    }

    public function storeRoleAccess($request)
    {
        $RoleAccess = new RoleAccess;
        $RoleAccess->system_access_id   = $request['system_access_id'];
        $RoleAccess->role_id            = $request['role_id'];
        return $RoleAccess->save();
    }

    public function updateRoleAccess($request, $id)
    {
        $RoleAccess = RoleAccess::find($id);
        $RoleAccess->system_access_id   = $request['system_access_id'];
        $RoleAccess->role_id            = $request['role_id'];
        return $RoleAccess->save();
    }

    public function deleteRoleAccess($id)
    {
        $result = false;
        
        $systems = RoleAccess::destroy($id);

        if ($systems) {
            $result = true;
        }
        return $result;
    }
}