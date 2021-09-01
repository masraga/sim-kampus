<?php  
namespace App\Services\Authentication;

use App\Models\User;

class Authenticate 
{
	public static $instance = null;

	private $username = "";
	private $password = "";

	public static function get_instance()
	{
		if( self::$instance == null ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * mengecek apakah adalah data user 
	 */
	private function userData()
	{
		$user  	  = new User();
		$where 	  = [ "email" => $this->username, "password" => $this->password ];
		$dataset  = $user->where($where)->find();
		$is_user  = count( $dataset ) > 0;

		return [ "is_user" => $is_user, "data" => $dataset ];
	}	

	/**
	 * autentikasi user
	 * 
	 * @param  $username username 
	 * @param  $password password
	 */
	public function auth( $username, $password ) 
	{
		$this->username = $username;
		$this->password = $password;
		
		if( ! $this->userData()["is_user"] ){
			return [
				"code" => 404,
				"msg"  => "Email atau password salah"
			];
		}
		else {
			return [
				"code" => 200,
				"msg"  => "success",
				"data" => $this->userData()["data"][0]
			];
		}
	}
}

?>