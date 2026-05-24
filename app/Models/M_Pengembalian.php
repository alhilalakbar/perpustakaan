<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pengembalian extends Model
{
    protected $table = 'tbl_pengembalian';

    // =========================
    // GET DATA PENGEMBALIAN
    // =========================
    public function getDataPengembalian($where = false)
    {
        $builder = $this->db->table($this->table);

        $builder->select('*');

        $builder->orderBy(
            'no_pengembalian',
            'DESC'
        );

        if ($where !== false) {
            $builder->where($where);
        }

        return $builder->get();
    }

    // =========================
    // GET DATA JOIN BUKU
    // =========================
    public function getDataPengembalianJoin($where = false)
    {
        $builder = $this->db->table('tbl_pengembalian');

        $builder->select(
            'tbl_pengembalian.no_pengembalian,
            tbl_pengembalian.no_peminjaman,
            tbl_pengembalian.id_buku,
            tbl_pengembalian.denda,
            tbl_pengembalian.tgl_pengembalian,
            tbl_buku.judul_buku'
        );

        $builder->join(
            'tbl_buku',
            'tbl_buku.id_buku = tbl_pengembalian.id_buku',
            'LEFT'
        );

        if ($where !== false) {
            $builder->where($where);
        }

        $builder->orderBy(
            'tbl_pengembalian.no_pengembalian',
            'DESC'
        );

        return $builder->get();
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function saveDataPengembalian($data)
    {
        $builder = $this->db->table($this->table);

        return $builder->insert($data);
    }
}