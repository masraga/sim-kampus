<?php  
namespace App\Services\Tagihan;

use App\Services\Tagihan\Generator;

class TagihanManager
{
	/**
	 * menambahkan tagihan baru
	 *
	 * @param array $request
	 */
	public static function add( $request )
	{
		$instance = Generator::getInstance();
		$setting = $instance->set( $request );

		if( $setting["code"] != 200 ) {
			return $setting["msg"];
		}

		return $instance->generate();
	}
}

?>