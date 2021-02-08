<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemAccessRequest;
use Illuminate\Http\Request;
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
            $result = $this->systemAccessInterface->load();
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function get($id)
    {
        try {
            $result = $this->systemAccessInterface->get($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(SystemAccessRequest $request)
    {
        try {
            $result = $this->systemAccessInterface->store($request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(SystemAccessRequest $request, $id)
    {
        try {
            $result = $this->systemAccessInterface->update($id, $request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->systemAccessInterface->delete($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
        }
    }
}
