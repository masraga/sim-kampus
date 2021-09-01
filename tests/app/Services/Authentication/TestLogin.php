<?php  
namespace App\Services\Authentication;

use CodeIgniter\Test\CIUnitTestCase;
use \App\Services\Authentication\Authenticate;

class TestLogin extends CIUnitTestCase 
{
	public function testIsUser()
	{
		$email 		= "admin@gmail.com";
		$password 	= "admin";
		$instance	= Authenticate::get_instance();
		$reflector  = new \ReflectionClass( "\\App\\Services\\Authentication\\Authenticate" );		

		// method for reflector
		$setEmail	 = $reflector->getMethod( "setEmail" );
		$setPassword = $reflector->getMethod( "setPassword" );
		$userData	 = $reflector->getMethod( "userData" );

		// set accessible
		$setEmail->setAccessible( true );
		$setPassword->setAccessible( true );
		$userData->setAccessible( true );

		// set data
		$resultEmail 	= $setEmail->invokeArgs( $instance, array( $email ) );
		$resultPassword = $setPassword->invokeArgs( $instance, array( $password ) );
		$resultData		= $userData->invokeArgs( $instance, array() )["is_user"];

		$errMsg = "Email : {$email} \n password : {$password} \n Tidak ditemukan";
		$this->assertSame( true, $resultData,  $errMsg);
	}
}

?>