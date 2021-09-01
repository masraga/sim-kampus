<?php  
namespace App\Services\Mahasiswa;

use App\Models\Mahasiswa;

/**
 * manajemen data pribadi mahasiswa
 */
class User {

	private static $instance = null;
	private $mahasiswa = null;

	public function __construct()
	{
		$this->mahasiswa = new Mahasiswa();
	}

	public static function get_instance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Menampilkan data mahasiswa
	 * 
	 * @param  array $queryString
	 * @return array
	 */
	public function list( $queryString )
	{
		if( count( $queryString ) == 0 )
			return $this->mahasiswa->findAll();

		if( isset( $queryString["user_nim"] ) )
			return $this->mahasiswa->where( [ "nim" => $queryString["user_nim"] ] )->first();
		if( isset( $queryString["user_email"] ) )
			return $this->mahasiswa->where( [ "email" => $queryString["user_email"] ] )->first();
	}
}

?>