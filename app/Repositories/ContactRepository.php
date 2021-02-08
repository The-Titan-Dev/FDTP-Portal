<?php

namespace App\Repositories;

use App\Interfaces\ContactInterface;
use App\Models\Contact;

class ContactRepository implements ContactInterface
{
    public function load()
    {
        return Contact::all();
    }

    public function get($id)
    {
        return Contact::find($id);
    }

    public function store($request)
    {
        $role = new Contact;
        $role->emp_id     = $request['emp_id'];
        $role->system_id  = $request['system_id'];
        $role->local_no   = $request['local_no'];
        return $role->save();
    }

    public function update($id, $request)
    {
        $data = Contact::find($id);
        $data->emp_id     = $request['emp_id'];
        $data->system_id  = $request['system_id'];
        $data->local_no   = $request['local_no'];
        return $data->save();
    }

    public function delete($id)
    {
        $result = false;

        $data = Contact::destroy($id);

        if ($data) {
            $result = true;
        }

        return $result;
    }
}
