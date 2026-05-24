<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Rak extends Model
{
    protected $table = 'tbl_rak';

    public function getDataRak($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');

        if ($where !== false) {
            $builder->where($where);
        }

        $builder->orderBy('nama_rak', 'ASC');
        return $builder->get();
    }

    public function saveDataRak($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataRak($data, $where)
    {
        return $this->db->table($this->table)->where($where)->update($data);
    }

    public function autoNumber()
    {
        return $this->db->table($this->table)
            ->select('id_rak')
            ->orderBy('id_rak', 'DESC')
            ->limit(1)
            ->get();
    }
}