<?php  
namespace App\Services\Mahasiswa;

use App\Services\Mahasiswa\User;

class MahasiswaManager 
{

	/**
	 * menampilkan data mahasiswa
	 *
	 * @param array $queryString
	 */
	public static function list( array $queryString = [] )
	{
		$user_instance = User::get_instance();

		return $user_instance->list( $queryString );		
	}
}

?>