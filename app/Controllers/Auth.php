<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\models\User;

class Auth extends \CodeIgniter\Controller
{
    use ResponseTrait;

    public function loginUser()
    {
		
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		
		$validation =  \Config\Services::validation();

		$params = [
            'username' => $username,
            'password' => $password
        ];

		if($validation->run($params, 'auth') == FALSE) {
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors(),
            ];

            return $this->respond($response, 500);
        }

		$model = new User();
		$user  = $model->signin($username, md5($password));
		
		if($user) {
			$response = [
                'status' => 200,
                'error' => false,
                'data' => $user,
            ];

			return $this->setResponseFormat('json')->respond($response, 200);
		} else {
			$response = [
                'status' => 500,
                'error' => true,
                'data' => [
					'message' => 'Username dan password tidak sesuai.'
				],
            ];

            return $this->respond($response, 500);	
		}


    }
}