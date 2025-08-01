<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatHutangModel extends Model
{
    protected $table = "riwayat_hutang";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;  
    protected $allowedFields = ['id_agent', 'tipe_pembayaran', 'nominal', 'tanggal_pembayaran', 'penginput'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

     // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
