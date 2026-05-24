<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Anggota extends Model
{
    protected $table = 'tbl_anggota';

    public function getDataAnggota($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where('is_delete_anggota', '0');
            $builder->orderBy('nama_anggota', 'ASC');
            return $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            return $builder->get();
        }
    }

    public function saveDataAnggota($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataAnggota($data, $where)
    {
        return $this->db->table($this->table)
                        ->where($where)
                        ->update($data);
    }

    public function autoNumber()
    {
        return $this->db->table($this->table)
                        ->select('id_anggota')
                        ->orderBy('id_anggota', 'DESC')
                        ->limit(1)
                        ->get();
    }
}