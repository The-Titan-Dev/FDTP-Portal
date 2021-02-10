<?php

namespace App\Repositories;

use App\Interfaces\SystemAccessInterface;
use App\Models\SystemAccess;
class SystemAccessRepository implements SystemAccessInterface
{
    public function loadAllSystemAccess()
    {
        return SystemAccess::all();
    }
    
    public function getSpecificSystemAccess($id)
    {
        return SystemAccess::find($id);
    }

    public function storeSystemAccess($request)
    {
        $SystemAccess = new SystemAccess;
        $SystemAccess->emp_id                = $request['emp_id'];
        $SystemAccess->system_id             = $request['system_id'];
        $SystemAccess->status                = $request['status'];
        $SystemAccess->save();
        $LastInsertId = $SystemAccess->id;
        return $LastInsertId;
    }

    public function updateSystemAccess($id, $request)
    {
        $SystemAccess = SystemAccess::find($id);
        $SystemAccess->emp_id                = $request['emp_id'];
        $SystemAccess->system_id             = $request['system_id'];
        $SystemAccess->status                = $request['status'];
        return $SystemAccess->save();
    }

    public function deleteSystemAccess($id)
    {
        $result = false;
        
        $systems = SystemAccess::destroy($id);

        if ($systems) {
            $result = true;
        }
        return $result;
    }
}

