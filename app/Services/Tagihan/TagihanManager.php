<?php  
namespace App\Services\Tagihan;

use App\Services\Tagihan\Generator;
use App\Services\Tagihan\FinancialRecord;

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

	/**
	 * mengambil data tagihan mahasiswa
	 * @param  string $token nim mahasiswa
	 * @return array
	 */
	public static function mahasiswa( $token = null )
	{
		$instance = FinancialRecord::getInstance();
		
		return $instance->setToken( $token )->list( $token );
	}

	/**
	 * menghapus data tagihan mahasiswa
	 *
	 * @param number $tagihan id tagihan
	 */
	public static function delete( $tagihan )
	{
		$instance = FinancialRecord::getInstance();

		return $instance->delete( $tagihan );
	}
}

?>