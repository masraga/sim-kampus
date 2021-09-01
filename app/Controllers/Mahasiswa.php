<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\Mahasiswa\MahasiswaManager;

class Mahasiswa extends ResourceController
{
	public function list()
	{
		return $this->respond( MahasiswaManager::list() );
	}
}
