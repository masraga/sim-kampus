<?php  
namespace App\Services\Authentication;

use App\Services\Authentication\Authenticate;

class AuthManager {

	public static function auth( $username, $password ) {
		$instance = Authenticate::get_instance();
		return $instance->auth( $username, $password );
	}  
}

?>