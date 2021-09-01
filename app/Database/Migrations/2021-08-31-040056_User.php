<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			"email" => [
				"type" => "varchar",
				"constraint" => 100,
			],
			"password" => [
				"type" => "varchar",
				"constraint" => 100
			],
			"role" => [
				"type" => "tinyint",
				"constraint" => 1 // 0 = leader 1 =  bendahara 2  =untuk siswa
			]
		]);
		$this->forge->addKey( "email", true );
		$this->forge->createTable( "user" );
	}

	public function down()
	{
		//
		$this->forge->dropTable( "user" );
	}
}
