<?php  
namespace App\Services\Tagihan;

use App\Models\Tagihan;

/**
 * class untuk mengupdate data pembayaran
 */
class ModifyRecord
{
	private $request = [];

	private $error = [];

	private $tagihan = null;

	public function __construct( $request )
	{
		$this->request = $request;
		$this->tagihan = new Tagihan;
	}

	/**
	 * cek apakah user tersedia
	 */
	private function checkCredential()
	{
		try {
			$tagihan = $this->tagihan->where( array(
				"nim_mahasiswa" => $this->request["nim"],
				"id"  => $this->request["id_tagihan"],
			) )
			->get()
			->getResultArray();

			if( count( $tagihan ) < 1 ) {
				$this->error = [
					"code" => 404,
					"msg"  => "Data tagihan tidak ditemukan"
				];
			}

			return [ "code" => 200, "msg" => "OK" ];
		}
		catch( \Exception $e ) {
			$this->error = [
				"code" => 500,
				"msg"  => "Terjadi kesalahan saat memvalidasi credential",
				"trace" => $e
			];
		}
	}

	/**
	 * validasi input sebelum dimasukkan ke db
	 */
	private function validate()
	{
		$this->checkCredential();

		if( empty( $this->error ) )
			return [ "code" => 200, "msg" => "OK" ];

		return $this->error;
	}

	/**
	 * update data di database
	 */
	private function update()
	{
		$dataset = [];
		$where = [];
		if( $this->request["tanggal_batas"] == "" ) {
			$dataset = [
				"jenis" 	=> $this->request["jenis_tagihan"],
				"jumlah" 	=> $this->request["jumlah_tagihan"],
				"is_lunas" 	=> intval( $this->request["is_lunas"] )
			];
		}
		else {
			$dataset = [
				"jenis" 		=> $this->request["jenis_tagihan"],
				"jumlah" 		=> $this->request["jumlah_tagihan"],
				"tanggal_batas" => $this->request["tanggal_batas"],
				"is_lunas" 		=> intval( $this->request["is_lunas"] )
			];
		}

		$where = [ 
			"nim_mahasiswa" => $this->request["nim"], 
			"id" => $this->request["id_tagihan"] 
		];

		try {
			$this->tagihan
			->where( $where )
			->set( $dataset )
			->update();

			return [
				"code"  => 200,
				"msg"	=> "Berhasil mengupdate data tagihan"
			];
		}
		catch( \Exception $e ) {
			return [
				"code"  => 500,
				"msg"   => "Terjadi kesalahan saat update data tagihan",
				"trace" => $e
			];
		}
	}

	public function run()
	{
		$this->validate();

		if( ! empty( $this->error ) ) {
			return $this->error;
		}

		return $this->update();
	}
}

?>