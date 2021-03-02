<?php

namespace App\Repositories;

use App\Interfaces\SystemAccessInterface;
use App\Models\SystemAccess;
class SystemAccessRepository implements SystemAccessInterface
{
    /**
     * Load all system access from storage
     * 
     * @return object data
     */
    public function loadAllSystemAccess()
    {
        return SystemAccess::all();
    }
    
    /**
     * Get the specific system access from storage
     * The parameter used was coming from Interface
     * 
     * @param $id
     * @return object data
     */
    public function getSpecificSystemAccess($id)
    {
        return SystemAccess::find($id);
    }

    /**
     * Store the created System Access in storage
     * The parameter used was coming from Interface
     * 
     * @param $request
     * @return true/false
     */
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

    /**
     * Update the specific system Access from storage
     * The parameter used was coming from Interface
     * 
     * @param $id
     * @param $request
     * @return true/false
     */
    public function updateSystemAccess($id, $request)
    {
        $SystemAccess = SystemAccess::find($id);
        $SystemAccess->emp_id                = $request['emp_id'];
        $SystemAccess->system_id             = $request['system_id'];
        $SystemAccess->status                = $request['status'];
        return $SystemAccess->save();
    }

    /**
     * Remove the specific System Access from storage
     * The parameter used was coming from Interface
     * 
     * @param $id
     * @return true/false
     */
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

