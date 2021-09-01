<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			"nim" => [
				"type" => "varchar",
				"constraint" => 12,
			],
			"email" => [
				"type" => "varchar",
				"constraint" => 100
			],
			"nama" => [
				"type" => "varchar",
				"constraint" => 50
			],
			"semester" => [
				"type" => "varchar",
				"constraint" => 2
			],
		]);
		$this->forge->addKey( "nim", true );
		$this->forge->addForeignKey( "email", "user", "email", "cascade", "cascade" );
		$this->forge->createTable( "mahasiswa" );
	}

	public function down()
	{
		//
		$this->forge->dropTable( "mahasiswa" );
	}
}
