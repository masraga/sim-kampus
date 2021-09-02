<?php  
namespace App\Services\Tagihan\Payment;

use App\Models\Tagihan;

abstract class PaymentInterface {
	protected $id;
	
	protected $token;

	protected $tagihan;

	public function __construct()
	{
		$this->tagihan = new Tagihan;
	}

	protected function getBill()
	{
		$cond = [ "nim_mahasiswa" => $this->token, "id" => $this->id ];
		
		return $this->tagihan->where( $cond )->find();
	}

	public function setToken( $token )
	{
		$this->token = $token;

		return $this;
	}

	public function setId( $id )
	{
		$this->id = $id;

		return $this;
	}

	abstract public function pay();

	/**
	 * ketika sudah selesai proses pembayaran update data di database
	 * @return
	 */
	protected function finish()
	{
		try {
			$this->tagihan
			->where( [ "nim_mahasiswa" => $this->token, "id" => $this->id  ] )
			->set( [ "is_lunas" => true ] )
			->update();

			return [
				"code" => 200,
				"msg"  => "Pembayaran telah selesai"
			];
		}
		catch( \Exception $e ) {
			return [
				"code" => 500,
				"msg"  => "Terjadi kesalahan saat melakukan pembayaran"
			];
		}
	}
}

?>