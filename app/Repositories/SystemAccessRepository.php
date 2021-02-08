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
        $data = new SystemAccess();
        $data->emp_id        = $request['emp_id'];
        $data->system_id     = $request['system_id'];
        $data->status        = $request['status'];
        return $data->save();
    }

    public function update($id, $request)
    {
        $data = SystemAccess::find($id);
        $data->emp_id        = $request['emp_id'];
        $data->system_id     = $request['system_id'];
        $data->status        = $request['status'];
        return $data->save();
    }

    public function delete($id)
    {
        $result = false;

        $data = SystemAccess::destroy($id);

        if ($data) {
            $result = true;
        }

        return $result;
    }
}
