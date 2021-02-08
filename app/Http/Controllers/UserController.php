<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HrisMasterlist;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ResponseAPI;
    protected $userInterface;


    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display all sections
     */
    public function load_sections()
    {
        try {
            $result = $this->userInterface->load_sections();
            return $this->success('Sections Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display HRIS masterlist
     */
    public function load_hris_masterlist()
    {
        try {
            $result = $this->userInterface->load_hris_masterlist();
            return $this->success('HRIS Data Loaded', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display specific user from hris
     */
    public function get_user_from_hris($emp_id)
    {
        try {
            $result = $this->userInterface->get_user_from_hris($emp_id);
            return $this->success('User Data Retrieved', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display specific user from system local data
     */
    public function get_user_from_local($emp_id)
    {
        try {
            $result =  $this->userInterface->get_user_from_local($emp_id);
            return $this->success('User Data Retrieved', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function authenticate($credentials)
    {
        try {
            return  $this->userInterface->authenticate($credentials);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * 1 = User dont exist in portal database
     * 2 = User dont exist in HRIS database
     * 3 = User successfully logged in
     * 4 = USer password incorrect;
     */
    public function login()
    {
        $validator = Validator::make(Request()->all(), [
            'emp_id' => 'required',
            'password' => 'required',
        ]);


        try {
            $emp_id = Request('emp_id');
            $password = Request('password');

            $local_data = $this->userInterface->get_user_from_local($emp_id);

            $result = [];
            if (empty($local_data['result'])) {
                $hris_data = $this->userInterface->get_user_from_hris($emp_id);
                if (empty($hris_data['result'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Employee Not Found';
                } else {
                    $result['status'] = 2;
                    $result['message'] = 'For Registration';
                }
            } else {
                $auth = $this->authenticate(Request()->only('emp_id', 'password'));

                if ($auth['status'] == true) {
                    $result['status'] = 3;
                    $result['message'] = "User Authenticated";
                    $result['data'] = $auth['user_data'];
                } else if ($auth['status'] == false) {
                    $result['status'] = 4;
                    $result['message'] = 'Invalid Password';
                }
            }
            return $this->success('User Authenticated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
