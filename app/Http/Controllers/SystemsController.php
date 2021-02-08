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
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result = $this->systemsInterface->get($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(SystemsStoreRequest $request)
    {
        try {
            $result = $this->systemsInterface->store($request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(SystemsStoreRequest $request, $id)
    {
        try {
            $result = $this->systemsInterface->update($id, $request->validated());
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->systemsInterface->delete($id);
            return $this->success('Successfully Executed', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
