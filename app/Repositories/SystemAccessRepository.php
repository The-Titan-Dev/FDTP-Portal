<?php

namespace App\Repositories;

use App\Interfaces\SystemAccessInterface;
use App\Models\SystemAccess;

class SystemAccessRepository implements SystemAccessInterface
{
    public function load()
    {
        return SystemAccess::all();
    }

    public function get($id)
    {
        return SystemAccess::find($id);
    }

    public function store($request)
    {
        $role = new SystemAccess();
        $role->emp_id        = $request['emp_id'];
        $role->system_id     = $request['system_id'];
        $role->status        = $request['status'];
        return $role->save();
    }

    public function update($id, $request)
    {
        $role = SystemAccess::find($id);
        $role->emp_id        = $request['emp_id'];
        $role->system_id     = $request['system_id'];
        $role->status        = $request['status'];
        return $role->save();
    }

    public function delete($id)
    {
        $result = false;

        $role = SystemAccess::destroy($id);

        if ($role) {
            $result = true;
        }

        return $result;
    }
}
