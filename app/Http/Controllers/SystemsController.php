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
            return $this->error($e->getMessage(), $e->getCode());
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
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function update(SystemsStoreRequest $request, $id)
    {
        try {
            Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('systems')->ignore($id),
                ],
                'reference_code'    => [
                    'required',
                    Rule::unique('systems')->ignore($id),
                ],
                'reference_number'  => [
                    'required',
                    Rule::unique('systems')->ignore($id),
                ],
                'description'       => 'required',
                'url'               => 'required|url',
                'date_deployed'     => 'required|date_format:Y-m-d',
                'status'            => 'required',
                'section_owner'     => 'required',
                'abbreviation'      => 'required',
            ]);

            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->systemsInterface->update($id,$request->validated());
            return $this->success('System added', 200, $result);
            
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->systemsInterface->delete($id);
            return $this->success('System deleted', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
