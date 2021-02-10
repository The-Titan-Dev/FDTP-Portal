<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAccessRequest;
use App\Interfaces\RoleAccessInterface;
use App\Traits\ResponseAPI;

class RoleAccessController extends Controller
{
    use ResponseAPI;
    protected $roleAccessInterface;


    public function __construct(RoleAccessInterface $roleAccessInterface)
    {
        $this->roleAccessInterface = $roleAccessInterface;
    }


    public function load()
    {
        try {
            $result = $this->roleAccessInterface->loadAllRoleAccess();
            return $this->success("RoleAccess Loaded", 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result = $this->roleAccessInterface->getSpecificRoleAccess($id);
            return $this->success("RoleAccess data Loaded", 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(RoleAccessRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->roleAccessInterface->storeRoleAccess($request);
            return $this->success("RoleAccess added",200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(RoleAccessRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->roleAccessInterface->updateRoleAccess($request, $id);
            return $this->success("RoleAccess update",200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->roleAccessInterface->deleteRoleAccess($id);
            return $this->success("RoleAccess deleted",200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
