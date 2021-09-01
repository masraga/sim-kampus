<?php  
namespace App\Services\FinancialRecord;

use CodeIgniter\Test\CIUnitTestCase;
use \App\Services\Tagihan\FinancialRecord;

class TestGetBill extends CIUnitTestCase
{
	private function setNim() 
	{
		return "1955201056";
	}

	private function setEmail()
	{
		return "real.ragamulia@gmail.com";
	}

	public function testGetByNim()
	{
		$instance  = FinancialRecord::getInstance(); 

		$reflector = new \ReflectionClass( "\\App\\Services\\Tagihan\\FinancialRecord" );
		
		$userToken = $reflector->getProperty( "userToken" );
		$getPersonalInfo = $reflector->getMethod( "getPersonalInfo" );
		
		$userToken->setAccessible( true );
		$getPersonalInfo->setAccessible( true );

		$userToken->setValue( $instance,  $this->setNim() );
		
		$info = $getPersonalInfo->invokeArgs( $instance, [] );
		$info = $info["data"][0]["nim_mahasiswa"]; 

		$expect = $this->setNim();
		$result = $info;

		$this->assertSame( $expect, $result, json_encode( $info ) );
	}

	public function testGetByEmail()
	{
		$instance  = FinancialRecord::getInstance(); 

		$reflector = new \ReflectionClass( "\\App\\Services\\Tagihan\\FinancialRecord" );
		
		$userToken = $reflector->getProperty( "userToken" );
		$getPersonalInfo = $reflector->getMethod( "getPersonalInfo" );
		
		$userToken->setAccessible( true );
		$getPersonalInfo->setAccessible( true );

		$userToken->setValue( $instance,  $this->setEmail() );
		
		$info = $getPersonalInfo->invokeArgs( $instance, [] );
		$info = $info["data"][0]["email"]; 

		$expect = $this->setEmail();
		$result = $info;

		$this->assertSame( $expect, $result, json_encode( $info ) );
	}
}

?>