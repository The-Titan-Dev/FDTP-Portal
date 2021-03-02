<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemAccessRequest;
use App\Interfaces\SystemAccessInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\DB;

class SystemAccessController extends Controller
{
    use ResponseAPI;
    protected $systemAccessInterface;

    /**
     * Constract the Interface to get Return Data
     * 
     * @param SystemAccessInterface $systemAccessInterface
     */
    public function __construct(SystemAccessInterface $systemAccessInterface)
    {
        $this->systemAccessInterface = $systemAccessInterface;
    }

    /**
     * Display all system access
     * 
     * @return error/success object data
     * 
     */
    public function load()
    {
        try {
            $result = $this->systemAccessInterface->loadAllSystemAccess();
            return $this->success('SystemAccess Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specific system access
     * The parameter used is coming from routes API
     * 
     * @param $id
     * @return error/success object data
     */
    public function get($id)
    {
        try {
            $result = $this->systemAccessInterface->getSpecificSystemAccess($id);
            return $this->success('SystemAccess data loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Store the created System Access
     * The paramater used is coming from SysteAccessRequest
     * 
     * @param SystemAccessRequest $request
     * @return warning/error/success true/false
     */
    public function store(SystemAccessRequest $request)
    {
        // return $request;
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

    /**
     * Udpate the specific SystemAccess
     * The parameter used are coming from SystemAccessRequest ang routes API
     * 
     * @param SystemAccessRequest $request
     * @param $id
     * @return warning/error/success true/false
     */
    public function update(SystemAccessRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->systemAccessInterface->updateSystemAccess($id, $request->validated());
            return $this->success('SystemAccess updated', 200, $result);
            DB::commit();
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
            DB::rollBack();
        }
    }

    /**
     * Remove the specific System Access
     * The parameter used is coming from routes API
     * 
     * @param $id
     * @return error/success true/false
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->systemAccessInterface->deleteSystemAccess($id);
            return $this->success('SystemAccess deleted', 200, $result);
            DB::commit();
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
            DB::rollBack();
        }
    }
}
