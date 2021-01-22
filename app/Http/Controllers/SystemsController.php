<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystems;
use App\Models\Systems;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use App\Interfaces\SystemsInterface;

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
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function store(StoreSystems $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->systemsInterface->store($request->validated());
            return $this->success('System added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
