<?php  
namespace App\Services\Tagihan\Payment;

use App\Services\Tagihan\Payment\PaymentInterface;

class Ovo extends PaymentInterface
{
	private static $instance = null;

	public function pay()
	{
		return $this->finish();
	}

	public static function getInstance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}