<?php  
namespace App\Services\Mahasiswa;

use App\Services\Mahasiswa\User;

class MahasiswaManager 
{

	/**
	 * menampilkan data mahasiswa
	 */
	public static function list()
	{
		$user_nim = $_GET["token"] ?? null;
		$user_instance = User::get_instance();

		return $user_instance->list( $user_nim );		
	}
}

?>