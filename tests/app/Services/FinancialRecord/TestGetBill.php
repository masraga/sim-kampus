<?php  
namespace App\Services\FinancialRecord;

use CodeIgniter\Test\CIUnitTestCase;
use \App\Services\Tagihan\FinancialRecord;

class TestGetBill extends CIUnitTestCase
{
	public function testGetWithAllRequest()
	{
		$testNim = 1955201056;
		$instance  = FinancialRecord::getInstance(); 

		$reflector = new \ReflectionClass( "\\App\\Services\\Tagihan\\FinancialRecord" );
		
		$clientRequest   = $reflector->getProperty( "request" );
		
		$clientRequest->setAccessible( true );

		$clientRequest->setValue( $instance,  array(
			"nim"   => $testNim,
			"email" => "real.ragamulia@gmail.com",
			"bill"  => 3
		) );
		
		$requestList = $reflector->getMethod( "getRequest" )
		->invokeArgs( $instance, [] );

		$this->assertIsArray( $requestList );
		$this->assertEquals( 3, count( $requestList ) );

		$queryResult = $reflector->getMethod( "list" )->invokeArgs( $instance, [] );

		$this->assertIsArray( $queryResult );
		$this->assertEquals( 3, count( $queryResult ) );
		$this->assertEquals( 200, $queryResult["code"] );
		$this->assertIsArray( $queryResult["data"] );
		$this->assertEquals( $testNim, $queryResult["data"][0]["nim_mahasiswa"] );

	}
}

?>