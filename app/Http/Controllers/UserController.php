<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HrisMasterlist;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\TokenInterface;

class UserController extends Controller
{
    use ResponseAPI;
    protected $userInterface;
    protected $tokenInterface;


    public function __construct(UserInterface $userInterface, TokenInterface $tokenInterface)
    {
        $this->userInterface = $userInterface;
        $this->tokenInterface = $tokenInterface;
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
            return $this->error($e->getMessage(),500);
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

        if ($validator->fails()) {
            return  $this->warning('Invalid inputs', 400, $validator->errors());
        } else {
            try {
                $emp_id = Request('emp_id');
                $password = Hash::make($emp_id);

                $local_data = $this->userInterface->get_user_from_local($emp_id);

                $result = [];
                if (empty($local_data)) {
                    $hris_data = $this->userInterface->get_user_from_hris($emp_id);
                    if (empty($hris_data)) {
                        $result['status'] = 1;
                        $result['message'] = 'Employee Not Found';
                    } 
                    else 
                    {
                        $data = [
                            'emp_id'    => $emp_id,
                            'password'  => $password
                        ];
                        try {
                            return  $this->userInterface->registeredUser($data);
                        } catch (\Exception $e) {
                            return $this->error($e->getMessage(), 500);
                        }
                    }
                } 
                else 
                {
                    $auth = $this->authenticate(Request()->only('emp_id', 'password'));

                    if ($auth['status'] == true) 
                    {
                        $result['status'] = 3;
                        $result['message'] = "User Authenticated";
                        $this->store($auth['user_info']->emp_id);
                        $hris_data = $this->userInterface->get_user_from_hris($auth['user_info']->emp_id);
                        if(count($auth['user_system_access']) > 0)
                        {
                            $result['data'] = $this->combinedataManpower($auth['user_info'], $hris_data,$auth['user_token'],$auth['user_system_access'], $auth['user_system'], $auth['user_system_role'], $auth['user_role_access'], $auth['user_system_contacts'], $auth['system_images']);
                        }
                        else
                        {
                            $result['data'] = $hris_data;
                        }
                    } 
                    else if ($auth['status'] == false) 
                    {
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

    public function combinedataManpower($portldata, $hrisdata, $usertoken, $systemaccess, $systems, $systemroles, $systemaccessroles, $usercontacts, $systemimages)
    {
        $result = [
            'emp_id'             => $portldata->emp_id,
            'last_name'          => $hrisdata->emp_last_name,
            'first_name'         => $hrisdata->emp_first_name,
            'middle_name'        => $hrisdata->emp_middle_name,
            'position'           => $hrisdata->position,
            'section_code'       => $hrisdata->section_code,
            'photo'              => $hrisdata->emp_photo,
            'token'              => $usertoken,
            'system_access'      => $systemaccess,
            'system'             => $systems,
            'roles'              => $systemroles,
            'role_access'        => $systemaccessroles,
            'contacts'           => $usercontacts,
            'images'             => $systemimages
        ];

       return $result;
    }

    public function store($data)
    {
        $datas = [
            'emp_id' => $data,
            'access_token_id' => 1
        ];
        try {
            $result = $this->tokenInterface->storeToken($datas);
            return $this->success('Token added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

}
