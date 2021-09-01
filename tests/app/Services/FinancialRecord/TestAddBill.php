<?php  
namespace App\Services\FinancialRecord;

use CodeIgniter\Test\CIUnitTestCase;
use \App\Services\Tagihan\Generator;

class TestAddBill extends CIUnitTestCase
{
	private function setForm()
	{
		return [
			"nim" => "1955201056",
			"jenis" => "SPP",
			"jumlah" => "3100000",
			"tanggal_batas" => date("Y-m-d")
		];
	}

	public function testSetForm()
	{
		$instance = Generator::getInstance();

		$settings 		= $instance->set( $this->setForm() );
		$expectedCode 	= 200;
		$resultCode   	= intval( $settings["code"] );

		$this->assertSame( $expectedCode, $resultCode, $settings["msg"] );
	}

	public function testInsertBill()
	{
		$instance = Generator::getInstance();

		$settings	= $instance->set( $this->setForm() );
		$insert 	= $instance->generate();

		$expectedCode 	= 200;
		$resultCode		= $insert["code"];

		$this->assertSame( $expectedCode, $resultCode, $insert["msg"] );
	}
}

?>