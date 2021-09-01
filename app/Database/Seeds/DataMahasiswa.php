<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataMahasiswa extends Seeder
{
	public function run()
	{
		$this->db->table( "mahasiswa" )->insert( [
			"nim" 		=> "1955201056",
			"email" 	=> "real.ragamulia@gmail.com",
			"nama" 		=> "RAGA MULIA KUSUMA",
			"semester" 	=> "5"
		] );
	}
}
