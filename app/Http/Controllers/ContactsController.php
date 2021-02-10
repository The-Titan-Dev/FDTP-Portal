<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Interfaces\ContactInterface;
use App\Traits\ResponseAPI;

class ContactsController extends Controller
{
    use ResponseAPI;
    protected $contactInterface;

    public function __construct(ContactInterface $contactInterface)
    {
        $this->contactInterface = $contactInterface;
    }

    public function load()
    {
        try {
            $result =  $this->contactInterface->loadAllContacts();
            return $this->success('Contacts Loaded', 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result =  $this->contactInterface->getSpecificContacts($id);
            return $this->success('Contacts data Loaded', 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(ContactRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->contactInterface->storeContacts($request->validated());
            return $this->success('Contacts added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(ContactRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }
            $result = $this->contactInterface->updateContacts($request->validated(), $id);
            return $this->success('Contacts updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result =  $this->contactInterface->deleteContacts($id);
            return $this->success('Contacts deleted', 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
