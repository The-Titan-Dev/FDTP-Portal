<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use ResponseAPI;
    protected $roleInterface;

    /**
     * Constract the Interface to get Return Data
     * 
     * @param RoleInterface $roleInterface
     */
    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }

    /**
     * Display All Roles
     * 
     * @return error/success object data
     */
    public function load($system_id)
    {
        try {
            $result = $this->roleInterface->load($system_id);
            return $this->success('Roles Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specific Role
     * The parameter used is coming from routes API
     * @param $id
     * @return error/success object data
     */
    public function get($id)
    {
        try {
            $result = $this->roleInterface->get($id);
            return $this->success('Role data loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Store the new created Role
     * The paramater used is coming from RoleRequest
     * 
     * @param RoleRequest $request
     * @return error/success true/false
     */
    public function store(RoleRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->roleInterface->store($request->validated());
            return $this->success('Role added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Update the specific Role
     * The paramater used is coming from routes API and RoleRequest
     * 
     * @param RoleRequest $request
     * @param $id
     * @return error/success true/false
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->roleInterface->update($id, $request->validated());
            return $this->success('Role updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specific Role
     * The paramater used is coming from routes API
     * 
     * @param $id
     * @return success/error true/false
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->roleInterface->delete($id);
            return $this->success('Role deleted', 200, $result);
            DB::commit();
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
            DB::rollBack();
        }
    }
}
