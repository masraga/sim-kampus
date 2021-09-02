<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Tagihan\TagihanManager;

class Tagihan extends BaseController
{
	public function add()
	{
		$tagihan = TagihanManager::add( $this->request->getPost() );

		session()->setFlashdata( "alert-msg", $tagihan["msg"] );
		session()->setFlashdata( "alert-code", $tagihan["code"] );
		
		if( $tagihan["code"] == 200  ) {
			$tokenMahasiswa = $tagihan["data"]["nim"];
			return redirect()->to( site_url( "/bendahara/tagihan/mahasiswa?nim={$tokenMahasiswa}" ) );
		}

		return redirect()->to( site_url( "/bendahara/tagihan/new" ) );
	}

	/**
	 * update tagihan mahasiswa
	 */
	public function update()
	{
		$tagihan = TagihanManager::update( $this->request->getPost() );
		$tokenMahasiswa = $this->request->getPost( "nim" );
		$tagihanMahasiswa = $this->request->getPost( "id_tagihan" );

		session()->setFlashdata( "alert-msg", $tagihan["msg"] );
		session()->setFlashdata( "alert-code", $tagihan["code"] );
		
		if( $tagihan["code"] == 200 ) {
			return redirect()->to( site_url( "/bendahara/tagihan/mahasiswa?nim={$tokenMahasiswa}" ) );
		}

		return redirect()->to( site_url( "/bendahara/tagihan/mahasiswa/edit?token={$tokenMahasiswa}&bill={$idTagihan}" ) );
	}
}
