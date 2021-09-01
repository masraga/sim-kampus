<?php  
namespace App\Services\MahasiswaData;

use CodeIgniter\Test\CIUnitTestCase;
use \App\Services\Mahasiswa\User;

class TestGetProfile extends CIUnitTestCase
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
		$instance = User::get_instance();
		$user     = $instance->list( [ "user_nim" => $this->setNim() ] );

		$expected = "1955201056";
		$result   = $user["nim"];

		$this->assertSame( $expected, $result, json_encode( $user ) );
	}

	public function testGetByEmail()
	{
		$instance = User::get_instance();
		$user     = $instance->list( [ "user_email" => $this->setEmail() ] );

		$expected = "real.ragamulia@gmail.com";
		$result   = $user["email"];

		$this->assertSame( $expected, $result, json_encode( $user ) );
	}
}

?>