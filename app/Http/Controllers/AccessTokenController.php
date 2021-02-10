<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessTokenRequest;
use App\Interfaces\AccessTokenInterface;
use App\Traits\ResponseAPI;

class AccessTokenController extends Controller
{
    use ResponseAPI;
    protected $accessTokenInterface;

    public function __construct(AccessTokenInterface $accessTokenInterface)
    {
        $this->accessTokenInterface = $accessTokenInterface;
    }

    public function load()
    {
        try {
            $result = $this->accessTokenInterface->loadAllAccessToken();
            return $this->success('AccessToken Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function get($id)
    {
        try {
            $result = $this->accessTokenInterface->getSpecificAccessToken($id);
            return $this->success('AccessToken data loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(AccessTokenRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->accessTokenInterface->storeAccessToken($request->validated());
            return $this->success('AccessToken added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(AccessTokenRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            $result = $this->accessTokenInterface->updateAccessToken($id, $request->validated());
            return $this->success('AccessToken updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->accessTokenInterface->deleteAccessToken($id);
            return $this->success('AccessToken deleted', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(),500);
        }
    }
}
