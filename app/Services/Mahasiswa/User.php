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
	 * @param  string $id nim mahasiswa
	 * @return array
	 */
	public function list( $id = null )
	{
		if( $id == null )
			return $this->mahasiswa->findAll();

		return $this->mahasiswa->find( [ "nim" => $id ] );
	}
}

?>