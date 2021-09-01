<?php  
namespace App\Services\Tagihan;

use App\Models\Mahasiswa;
use App\Models\Tagihan;

class Generator
{
	private static $instance = null;

	private $mahasiswa; // model mahasiswa

	private $nim = "";
	private $semester = "";
	private $jenis = "";
	private $jumlah = 0;
	private $tanggalDibuat = null;
	private $tanggalBatas = "";
	private $isLunas = false;

	public function __construct()
	{
		$this->mahasiswa = new Mahasiswa;
		$this->tagihan 	 = new Tagihan;
	}

	public static function getInstance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * mengambil data semester mahasiswa
	 *
	 * @param string $token nim mahasiswa
	 * 
	 * @return string
	 */
	private function getSemester( $token )
	{
		$user = $this->mahasiswa->find( [ "nim" => $token ] );

		return $user[0]["semester"];
	}

	/**
	 * membuat data tagihan
	 *
	 * @param array $params data tagihan
	 */
	public function set( array $params )
	{

		$error = null;

		if( ! isset( $params[ "nim" ] ) )
			$error = "nim harus diisi";
		if( ! isset( $params[ "jenis" ] ) )
			$error = "Jenis pembayaran harus diisi";
		if( ! isset( $params[ "jumlah" ] ) )
			$error = "Jumlah pembayaran harus diisi";
		if( ! isset( $params[ "tanggal_batas" ] ) )
			$error = "Batas tanggal pembayaran harus diisi";
		if( $error != null ) {
			return [
				"code" 	=> 406,
				"msg" 	=> $error
			];
		}

		$this->nim 			 = $params["nim"];
		$this->jenis 		 = $params["jenis"];
		$this->jumlah 		 = $params["jumlah"];
		$this->tanggalBatas  = $params["tanggal_batas"];
		$this->tanggalDibuat = date("Y-m-d");
		$this->semester 	 = $this->getSemester( $params["nim"] );

		return [
			"code" => 200,
			"msg"  => "succes"
		];
	}

	/**
	 * menambahkan tagihan ke database
	 */
	public function generate()
	{
		try {
			$this->tagihan->insert([
				"semester" => $this->semester,
				"jenis" => $this->jenis,
				"nim_mahasiswa" => $this->nim,
				"jumlah" => $this->jumlah,
				"tanggal_dibuat" => $this->tanggalDibuat,
				"tanggal_batas" => $this->tanggalBatas,
			]);

			return [
				"code" => 200,
				"msg"  => "Tagihan {$this->nim} berhasil ditambah",
				"data" => [
					"nim" => $this->nim
				]
			];
		}
		catch( \Exceptiion $e ) {
			return [
				"code" => 500,
				"msg"  => $e
			];
		}
	}
}

?>