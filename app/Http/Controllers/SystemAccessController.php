<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemAccessRequest;
use App\Interfaces\SystemAccessInterface;
use App\Traits\ResponseAPI;

class SystemAccessController extends Controller
{
    use ResponseAPI;
    protected $systemAccessInterface;

    public function __construct(SystemAccessInterface $systemAccessInterface)
    {
        $this->systemAccessInterface = $systemAccessInterface;
    }

    public function load()
    {
        try {
            $result = $this->systemAccessInterface->loadAllSystemAccess();
            return $this->success('SystemAccess Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result = $this->systemAccessInterface->getSpecificSystemAccess($id);
            return $this->success('SystemAccess data loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(SystemAccessRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->systemAccessInterface->storeSystemAccess($request->validated());
            return $this->success('SystemAccess added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(SystemAccessRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->systemAccessInterface->updateSystemAccess($id, $request->validated());
            return $this->success('SystemAccess updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->systemAccessInterface->deleteSystemAccess($id);
            return $this->success('SystemAccess deleted', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
        }
    }
}
