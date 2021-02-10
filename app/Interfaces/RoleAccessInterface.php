<?php

namespace App\Interfaces;

interface RoleAccessInterface
{
    public function loadAllRoleAccess();

    public function getSpecificRoleAccess($id);

    public function storeRoleAccess($request);

    public function updateRoleAccess($request, $id);

    public function deleteRoleAccess($id);
}