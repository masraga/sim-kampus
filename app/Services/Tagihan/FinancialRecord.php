<?php  
namespace App\Services\Tagihan;

use App\Models\TagihanMahasiswa;
use App\Models\Tagihan;

/**
 * class untuk melihat catatan keuangan
 * tiap mahasiswa 
 */
class FinancialRecord
{

	private static $instance = null;

	/**
	 * nim mahasiswa
	 * @var null
	 */
	private $userToken = null;

	/**
	 * model tagihan mahasiswa
	 * @var null
	 */
	private $mahasiswa = null;

	/**
	 * model tagihan
	 * @var null
	 */
	private $tagihan = null;

	public function __construct()
	{
		$this->mahasiswa = new TagihanMahasiswa;
		$this->tagihan   = new Tagihan;
	}

	public static function getInstance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * mengatur nim mahasiswa
	 *
	 * @param string 	$token 	nim mahasiswa
	 */
	public function setToken( $token )
	{
		$this->userToken = $token;
		return $this;
	}

	/**
	 * mengubah hasil string biasa pada query jadi string yang 
	 * memiliki format contoh : 1000 -> Rp 1.000
	 * 
	 * @param  array $result
	 * @return array
	 */
	private function formatingInfoResult( $result )
	{
		return array_map(function( $value ){
			$value["jumlah_tagihan"] = "Rp " . number_format($value["jumlah_tagihan"],0,',','.');
			$value["tanggal_dibuat"] = date( "d F Y", strtotime( $value["tanggal_dibuat"] ) );
			$value["tanggal_batas"] = date( "d F Y", strtotime( $value["tanggal_batas"] ) );
			
			return $value;
		}, $result);
	}

	/**
	 * mengambil data keuangan 1 mahasiswa
	 * @return array
	 */
	private function getPersonalInfo()
	{
		$tagihan = $this->mahasiswa->getInfo( $this->userToken );
		$tagihan = $this->formatingInfoResult( $tagihan );

		return [
			"code" 	=> 200,
			"msg"	=> "success",
			"data"	=> $tagihan
		];
	}

	/**
	 * mengambil semua data keuangan mahasiswa
	 * @return array
	 */
	private function getAllInfo()
	{

	}

	/**
	 * menghapus data tagihan mahasiswa
	 * 
	 * @param  number $tagihan id tagihan
	 */
	public function delete( $tagihan )
	{
		try {
			$this->tagihan->delete( $tagihan );

			return [
				"code" 	=> 200, 
				"msg"	=> "Berhasil menghapus data tagihan"
			];
		}
		catch( \Exception $e ) {
			return [
				"code" 	=> 500, 
				"msg"	=> "Terjadi kesalahan saat menghapus tagihan"
			];
		}
	}

	/**
	 * menampilkan data pembayaran mahasiswa
	 * @return array
	 */
	public function list()
	{
		if( $this->userToken != null ) 
			return $this->getPersonalInfo();

		return $this->getAllInfo(); 
	}
}

?>