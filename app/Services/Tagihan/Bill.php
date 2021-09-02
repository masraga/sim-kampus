<?php  
namespace App\Services\Tagihan;

use App\Services\Tagihan\Payment\PaymentManager;

class Bill
{
	private static $instance = null;

	/**
	 * nim mahasiswa
	 * @var null
	 */
	private $token = null;

	/**
	 * id tagihan
	 * @var null
	 */
	private $id = null;

	/**
	 * indicator jika terjadi error saat validasi
	 * @var boolean
	 */
	private $error = false;

	public static function getInstance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * mengatur value tagihan yang akan dibayar
	 * 
	 * @param array $tagihan
	 */
	public function set( array $tagihan )
	{
		if( ! isset( $tagihan["id"] ) )
			$this->error = "parameter id harus diisi";
		if( ! isset( $tagihan["token"] ) )
			$this->error = "parameter token harus diisi";

		if( $this->error )
			return $this;

		$this->id = $tagihan["id"];
		$this->token = $tagihan["token"];

		return $this;
	}

	/**
	 * validasi data pembayaran
	 * @return [type] [description]
	 */
	private function validate()
	{
		if( $this->error )
			return [ "code" => 406, "msg" => $this->error ];

		return [ "code" => 200, "msg" => "OK" ];;
	}

	/**
	 * bayar tagihan
	 * @return [type] [description]
	 */
	public function pay()
	{
		if( $this->validate()["code"] != 200 )
			return $this->validate();


		$payment = new PaymentManager;

		return $payment
		->setChannel( PaymentManager::OVO )
		->setData( [ "id" => $this->id , "token" => $this->token ] )
		->pay();
	}
}

?>