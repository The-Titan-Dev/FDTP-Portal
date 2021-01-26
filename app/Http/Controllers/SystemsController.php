<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemsStoreRequest;
use App\Models\Systems;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use App\Interfaces\SystemsInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SystemsController extends Controller
{
    use ResponseAPI;
    protected $systemsInterface;

    public function __construct(SystemsInterface $systemsInterface)
    {
        $this->systemsInterface = $systemsInterface;
    }

    public function load()
    {
        try {
            $result = $this->systemsInterface->load();
            return $this->success('Systems Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result = $this->systemsInterface->get($id);
            return $this->success('Systems data loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(SystemsStoreRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->systemsInterface->store($request->validated());
            return $this->success('System added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(SystemsStoreRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->systemsInterface->update($id, $request->validated());
            return $this->success('System updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->systemsInterface->delete($id);
            return $this->success('System deleted', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
