<?php

namespace App\Controllers\Api;

use \CodeIgniter\RESTful\ResourceController;
use App\Services\Tagihan\TagihanManager;

class Tagihan extends ResourceController
{
	/**
	 * mengambil list tagihan mahasiswa
	 */
	public function mahasiswa()
	{
		$token = $this->request->getGet( "token" );

		if( isset( $token ) )
			return $this->respond( TagihanManager::mahasiswa( $token ) );
		
		return $this->respond( TagihanManager::mahasiswa() );
	}
}
