<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use App\Interfaces\RoleInterface;
use App\Traits\ResponseAPI;

class RoleController extends Controller
{
    use ResponseAPI;
    protected $roleInterface;

    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }

    public function load()
    {
        try {
            $result = $this->roleInterface->load();
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function get($id)
    {
        try {
            $result = $this->roleInterface->get($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(RoleRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->roleInterface->store($request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->roleInterface->update($id, $request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->roleInterface->delete($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
        }
    }
}
