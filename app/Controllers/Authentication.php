<?php  
namespace App\Controllers;

use App\Services\Authentication\AuthManager;

class Authentication extends BaseController
{
	/**
	 * melakukan autentikasi login
	 */
	public function authenticate()
	{
		$email = $_POST["email"];
		$password = sha1( $_POST["password"] );

		$auth = AuthManager::auth( $email, $password );

		if( $auth["code"] == 200 ) {
			session()->set([
				"token" => $auth["data"]["email"],
				"role"  => $auth["data"]["role"],
			]);

			switch( $auth["data"]["role"] ) {
				case 0 : {
					return redirect()->to(site_url("/admin"));
				}
				case 1 : {
					return redirect()->to(site_url("/bendahara"));
				}
				case 2 : {
					return redirect()->to(site_url("/mahasiswa"));
				}
			} 
		}
	}

	/**
	 * logout dari sistem
	 */
	public function logout()
	{
		session()->remove( "token" );
		session()->remove( "role" );

		return redirect()->to( site_url( "/" ) );
	}
}

?>