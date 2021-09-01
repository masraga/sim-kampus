<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataUser extends Seeder
{
	public function run()
	{
		//
		$this->db->table( "user" )->insert([
			"email" => "admin@gmail.com",
			"password" => sha1( "admin" ),
			"role" => 0
		]);

		$this->db->table( "user" )->insert([
			"email" => "bendahara@gmail.com",
			"password" => sha1( "bendahara" ),
			"role" => 1
		]);

		$this->db->table( "user" )->insert([
			"email" => "real.ragamulia@gmail.com",
			"password" => sha1( "raga" ),
			"role" => 2
		]);
	}
}
