<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table  = 'admin_users';

	public function signin($username, $password) {

		return $this->getWhere(["username" => $username, "password" => $password])->getResult();
	}
}
