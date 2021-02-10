<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Interfaces\ImageInterface;
use App\Traits\ResponseAPI;

class ImagesController extends Controller
{
    use ResponseAPI;
    protected $imageInterface;

    public function __construct(ImageInterface $imageInterface)
    {
        $this->imageInterface = $imageInterface;
    }

    public function load()
    {
        try {
            $result = $this->imageInterface->loadAllImages();
            return $this->success("Images Loaded", 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function get($id)
    {
        try {
            $result = $this->imageInterface->getSpecificImages($id);
            return $this->success("Images data Loaded", 200, $result);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(ImageRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            if ($request->hasFile('logo')) {
                $destination = "/uploads/fdtp_portal_system_images/logo/";
                $tmp_name = $_FILES['logo']['tmp_name'];
                $file_name_logo = time() . '_' . $_FILES['logo']['name'];

                $this->uploadTo211($tmp_name, $file_name_logo, $destination);
            }
            if ($request->hasFile('main_image')) {
                $destination = "/uploads/fdtp_portal_system_images/main/";
                $tmp_name = $_FILES['main_image']['tmp_name'];
                $file_name_main = time() . '_' . $_FILES['main_image']['name'];

                $this->uploadTo211($tmp_name, $file_name_main, $destination);
            }

            $data = [
                'system_id'     => $request->system_id,
                'logo'          => $file_name_logo,
                'main_image'    => $file_name_main

            ];

            $result = $this->imageInterface->storeImages($data);
            return $this->success('Images added', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function update(ImageRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return $this->warning('Invalid Inputs', 400, $request->validator->errors());
            }

            if ($request->hasFile('logo')) {
                $destination = "/uploads/fdtp_portal_system_images/logo/";
                $tmp_name = $_FILES['logo']['tmp_name'];
                $file_name_logo = time() . '_' . $_FILES['logo']['name'];

                $this->uploadTo211($tmp_name, $file_name_logo, $destination);
            }
            if ($request->hasFile('main_image')) {
                $destination = "/uploads/fdtp_portal_system_images/main/";
                $tmp_name = $_FILES['main_image']['tmp_name'];
                $file_name_main = time() . '_' . $_FILES['main_image']['name'];

                $this->uploadTo211($tmp_name, $file_name_main, $destination);
            }

            $data = [
                'system_id'     => $request->system_id,
                'logo'          => $file_name_logo,
                'main_image'    => $file_name_main

            ];

            $result = $this->imageInterface->updateImages($data, $id);
            return $this->success('Images Updated', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->imageInterface->deleteImages($id);
            return $this->success('Images deleted', 200, $result);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function uploadTo211($file_tmp, $file, $folder_name)
    {
        $ftp_server = '10.164.20.211';
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        $ftp_username = "anonymous";
        $ftp_userpass = "Fdtp111";
        $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
        $result = [];
        $ftp = ftp_put($ftp_conn, $folder_name . $file, $file_tmp, FTP_BINARY);

        if ($ftp) {
            return $ftp;
        } else {
            return 'error';
        }

        ftp_close($ftp_conn);
        return $result;
    }
}
