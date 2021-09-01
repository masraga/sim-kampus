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

		if( $this->request->getGet( "use-email" ) ) {
			$token = session()->get( "token" );
		}

		if( isset( $token ) )
			return $this->respond( TagihanManager::mahasiswa( $token ) );
		
		return $this->respond( TagihanManager::mahasiswa() );
	}

	/**
	 * menghapus data tagihan mahasiswa
	 *
	 * @param string $tagihan 	id tagihan
	 * @param string $token 	nim mahasiswa
	 */
	public function delete_tagihan( $tagihan, $token )
	{
		$tagihan = TagihanManager::delete( $tagihan );

		session()->setFlashdata( "alert-msg", $tagihan["msg"] );
		session()->setFlashdata( "alert-code", $tagihan["code"] );
		return redirect()->to( site_url("/bendahara/tagihan/mahasiswa?nim={$token}") );
	}
}
