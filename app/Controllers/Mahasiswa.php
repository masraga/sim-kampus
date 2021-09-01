<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\Mahasiswa\MahasiswaManager;

class Mahasiswa extends ResourceController
{
	public function list()
	{
		if( $this->request->getGet( "use-email" ) ) {
			$queryString = [
				"user_email" => session()->get( "token" ),
				"user_nim"	 => $this->request->getGet( "nim" )
			];
		}

		return $this->respond( MahasiswaManager::list( $queryString ) );
	}
}
