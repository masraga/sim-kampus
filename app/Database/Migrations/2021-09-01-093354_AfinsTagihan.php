<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AfinsTagihan extends Migration
{
	public function up()
	{
		//
		$this->db->query( "
			CREATE TRIGGER afins_tagihan 
			AFTER INSERT ON tagihan 
			FOR EACH ROW 
			INSERT INTO tagihan_mahasiswa SET 
			nim_mahasiswa = new.nim_mahasiswa,
			id_tagihan = new.id
		" );
	}

	public function down()
	{
		//
		$this->db->query( "DROP TRIGGER afins_tagihan" );
	}
}
