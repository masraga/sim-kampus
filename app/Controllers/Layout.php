<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Layout extends BaseController
{
	/**
	 * menampilkan halaman login untuk sistem
	 */
	public function init()
	{
		return view( "login" );
	}

	/**
	 * menampilkan home admin
	 */
	public function admin_home()
	{
		return view( "admin/home" );
	}

	/**
	 * menampilkan home bendahara
	 */
	public function bendahara_home()
	{
		return view( "bendahara/home" );
	}

	/**
	 * menampilkan data tagihan mahasiswa
	 */
	public function bendahara_tagihan_mahasiswa()
	{
		return view( "bendahara/tagihan-mahasiswa" );
	}

	/**
	 * menampilkan form tambah tagihan
	 */
	public function bendahara_tagihan_new()
	{
		return view( "bendahara/tagihan-new" );
	}

	/**
	 * menampilkan halaman home mahasiswa
	 */
	public function mahasiswa_home()
	{
		return view( "mahasiswa/home" );
	}
}
