<?php  
namespace App\Services\Tagihan\Payment;

use App\Services\Tagihan\Payment\Ovo;

class PaymentManager
{
	public const OVO = 0;
	public const BANK = 1;

	private $paymentMethod = null;

	private $paymentData  = null;

	/**
	 * mengatur payment channel
	 */
	public function setChannel( $channel )
	{
		$this->paymentMethod = $channel;
		return $this;
	}

	/**
	 * mengatur data tagihan
	 */
	public function setData( $data )
	{
		$this->paymentData = $data;
		return $this;
	}

	/**
	 * bayar tagihan
	 * 
	 * @param  array $conf konfigurasi pembayaran
	 * @return
	 */
	public function pay()
	{
		switch( $this->paymentMethod ) {
			case self::OVO : {
				return $this->payWithOVO();
				break;
			}

			default : {
				return $this->payWithOVO();
				break;
			}
		}
	}

	private function payWithOVO()
	{
		$instance = Ovo::getInstance();

		return $instance
		->setId( $this->paymentData["id"] )
		->setToken( $this->paymentData["token"] )
		->pay();
	}
}

?>