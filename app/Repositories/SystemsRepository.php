<?php

namespace App\Repositories;

use App\Interfaces\SystemsInterface;
use App\Models\Systems;

class SystemsRepository implements SystemsInterface
{
    public function load()
    {
        return Systems::all();
    }

    public function store($request)
    {
        $systems = new Systems;
        $systems->name              = $request['name'];
        $systems->abbreviation      = $request['abbreviation'];
        $systems->reference_code    = $request['reference_code'];
        $systems->reference_number  = $request['reference_number'];
        $systems->description       = $request['description'];
        $systems->url               = $request['url'];
        $systems->date_deployed     = $request['date_deployed'];
        $systems->status            = $request['status'];
        $systems->section_owner     = $request['section_owner'];
        return $systems->save();
    }

    public function update($id, $request)
    {
        $systems = Systems::find($id);
        $systems->name              = $request['name'];
        $systems->abbreviation      = $request['abbreviation'];
        $systems->reference_code    = $request['reference_code'];
        $systems->reference_number  = $request['reference_number'];
        $systems->description       = $request['description'];
        $systems->url               = $request['url'];
        $systems->date_deployed     = $request['date_deployed'];
        $systems->status            = $request['status'];
        $systems->section_owner     = $request['section_owner'];
        return $systems->save();
    }

    public function delete($id)
    {
        $result = Systems::destroy($id);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }
}
