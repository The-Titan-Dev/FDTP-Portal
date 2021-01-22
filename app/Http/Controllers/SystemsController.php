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
            return $this->systemsInterface->load();
        } catch (\Exception $e) {
        }
    }

    public function store(StoreSystems $request)
    {
        if ($request->validator->fails()) {
            return $data = [
                "code"        => 400,
                "status"      => "warning",
                "data"        => $request->validator->errors()
            ];
        }
    }
}
