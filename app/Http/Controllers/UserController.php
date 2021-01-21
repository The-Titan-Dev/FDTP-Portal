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
        return $this->userInterface->load_sections();
    }

    /**
     * Display HRIS masterlist
     */
    public function load_hris_masterlist()
    {
        return $this->userInterface->load_hris_masterlist();
    }

    /**
     * Display specific user from hris
     */
    public function get_user_from_hris($emp_id)
    {
        return $this->userInterface->get_user_from_hris($emp_id);
    }

    /**
     * Display specific user from system local data
     */
    public function get_user_from_local($emp_id)
    {
        return $this->userInterface->get_user_from_local($emp_id);
    }

    public function authenticate($credentials)
    {
        return  $this->userInterface->authenticate($credentials);
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

        if ($validator->fails()) {
            return $data = [
                "code"        => 400,
                "status"      => "warning",
                "data"        => $validator->errors()
            ];
        } else {
            $emp_id = Request('emp_id');
            $password = Request('password');

            $local_data = $this->get_user_from_local($emp_id);

            $result = [];
            if (empty($local_data['result'])) {
                $hris_data = $this->get_user_from_hris($emp_id);
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

            return $this->success("Successfully Executed", $result);
            // return $result;
        }
    }
}
