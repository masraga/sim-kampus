<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanMahasiswa extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tagihan_mahasiswa';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	/**
	 * mengambil data tagihan mahasiswa
	 * 
	 * @param  string $token nim mahasiswa
	 * 
	 * @return array 
	 */
	public function getInfo( $token = null )
	{
		$builder = $this->db->table( $this->table );

		$builder->select([
			"{$this->table}.nim_mahasiswa",
			"{$this->table}.id_tagihan",
			"mahasiswa.nama",
			"mahasiswa.semester as mahasiswa_semester",
			"tagihan.semester as tagihan_semester",
			"tagihan.jenis as jenis_tagihan",
			"tagihan.jumlah as jumlah_tagihan",
			"tagihan.tanggal_dibuat",
			"tagihan.tanggal_batas",
			"tagihan.is_lunas",
		]);

		if( $token != null ) {
			$builder->where( "{$this->table}.nim_mahasiswa", $token );
		}

		$builder->join( "mahasiswa", "mahasiswa.nim = {$this->table}.nim_mahasiswa" );
		$builder->join( "tagihan", "tagihan.id = {$this->table}.id_tagihan" );
		
		return $builder->get()->getResultArray();
	}
}
