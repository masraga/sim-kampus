<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TagihanMahasiswa extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			"nim_mahasiswa" => [
				"type" => "varchar",
				"constraint" => 12,
			],
			"id_tagihan" => [
				"type" => "int",
				"constraint" => 3,
			],
		]);

		$this->forge->addForeignKey( "id_tagihan", "tagihan", "id", "cascade", "cascade" );
		$this->forge->createTable( "tagihan_mahasiswa" );
	}

	public function down()
	{
		//
		$this->forge->dropTable( "tagihan_mahasiswa", true );
	}
}
