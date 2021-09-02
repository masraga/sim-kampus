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
		$request = array();
		
		$request[ "token" ] = $this->request->getGet( "token" );

		if( $this->request->getGet( "use-email" ) ) {
			$request[ "token" ] = session()->get( "token" );
		}
		if( $this->request->getGet( "bill" ) ) {
			$request[ "bill" ] = $this->request->getGet( "bill" );
		}

		if( ! empty( $request ) )
			return $this->respond( TagihanManager::mahasiswa( $request ) );
		
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

	/**
	 * bayar tagihan
	 */
	public function pay()
	{
		return $this->respond( TagihanManager::pay( $this->request->getPost() ) );
	}
}
