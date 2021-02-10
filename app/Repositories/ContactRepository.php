<?php

namespace  App\Repositories;

use App\Interfaces\ContactInterface;
use App\Models\Contacts;

class ContactRepository implements ContactInterface
{
    public function loadAllContacts()
    {
        return Contacts::all();
    }

    public function getSpecificContacts($id)
    {
        return Contacts::find($id);
    }

    public function storeContacts($request)
    {
        $Contacts = new Contacts;
        $Contacts->emp_id       = $request['emp_id'];
        $Contacts->system_id    = $request['system_id'];
        $Contacts->local_no     = $request['local_no'];
        return $Contacts->save();
    }

    public function updateContacts($request, $id)
    {
        $Contacts = Contacts::find($id);
        $Contacts->emp_id       = $request['emp_id'];
        $Contacts->system_id    = $request['system_id'];
        $Contacts->local_no     = $request['local_no'];
        return $Contacts->save();
    }

    public function deleteContacts($id)
    {
        $result = false;
        
        $systems = Contacts::destroy($id);

        if ($systems) 
        {
            $result = true;
        }
        return $result;
    }

}