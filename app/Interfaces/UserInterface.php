<?php

namespace App\Interfaces;
interface UserInterface
{
    public function load_sections();

    public function load_hris_masterlist();

    public function get_user_from_hris($emp_id);

    public function get_user_from_local($emp_id);

    public function authenticate($credentials);

    public function registeredUser($empid);
}
