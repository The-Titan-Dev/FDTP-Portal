<?php

namespace App\Interfaces;


interface SystemAccessInterface
{
    public function loadAllSystemAccess();

    public function getSpecificSystemAccess($id);

    public function storeSystemAccess($request);

    public function updateSystemAccess($id, $request);

    public function deleteSystemAccess($id);

}