<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dashboard extends Model
{
    protected $DBGroup = 'default';

    /*
    |--------------------------------------------------------------------------
    | KPI
    |--------------------------------------------------------------------------
    */

    public function totalBuku()
    {
        return $this->db->table('tbl_buku')
            ->where('is_delete_buku', '0')
            ->countAllResults();
    }

    public function totalAnggota()
    {
        return $this->db->table('tbl_anggota')
            ->where('is_delete_anggota', '0')
            ->countAllResults();
    }

    public function totalKategori()
    {
        return $this->db->table('tbl_kategori')
            ->where('is_delete_kategori', '0')
            ->countAllResults();
    }

    public function totalStok()
    {
        $result = $this->db->table('tbl_buku')
            ->selectSum('jumlah_eksemplar')
            ->where('is_delete_buku', '0')
            ->get()
            ->getRow();

        return $result->jumlah_eksemplar ?? 0;
    }

    public function totalDipinjam()
    {
        return $this->db->table('tbl_detail_peminjaman')
            ->where('status_pinjam', 'Sedang Dipinjam')
            ->countAllResults();
    }

    public function totalDikembalikan()
    {
        return $this->db->table('tbl_pengembalian')
            ->countAllResults();
    }

    public function totalTerlambat()
    {
        return $this->db->table('tbl_detail_peminjaman')
            ->where('status_pinjam', 'Sedang Dipinjam')
            ->where('tgl_kembali <', date('Y-m-d'))
            ->countAllResults();
    }

    public function totalDenda()
    {
        $result = $this->db->table('tbl_pengembalian')
            ->selectSum('denda')
            ->get()
            ->getRow();

        return $result->denda ?? 0;
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI HARI INI
    |--------------------------------------------------------------------------
    */

    public function transaksiHariIni()
    {
        return $this->db->table('tbl_peminjaman')
            ->where('tgl_pinjam', date('Y-m-d'))
            ->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI TERBARU
    |--------------------------------------------------------------------------
    */

    public function transaksiTerbaru($limit = 5)
    {
        return $this->db->table('tbl_peminjaman p')
            ->select('
                p.no_peminjaman,
                p.tgl_pinjam,
                p.status_transaksi,
                a.nama_anggota,
                b.judul_buku,
                dp.status_pinjam,
                dp.tgl_kembali
            ')
            ->join('tbl_anggota a', 'a.id_anggota = p.id_anggota')
            ->join('tbl_detail_peminjaman dp', 'dp.no_peminjaman = p.no_peminjaman')
            ->join('tbl_buku b', 'b.id_buku = dp.id_buku')
            ->orderBy('p.tgl_pinjam', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | BUKU POPULER
    |--------------------------------------------------------------------------
    */

    public function bukuPopuler($limit = 5)
    {
        return $this->db->table('tbl_detail_peminjaman dp')
            ->select('b.judul_buku, COUNT(dp.id_buku) as total')
            ->join('tbl_buku b', 'b.id_buku = dp.id_buku')
            ->groupBy('dp.id_buku')
            ->orderBy('total', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | ANGGOTA PALING AKTIF
    |--------------------------------------------------------------------------
    */

    public function anggotaAktif($limit = 5)
    {
        return $this->db->table('tbl_peminjaman p')
            ->select('a.nama_anggota, COUNT(p.id_anggota) as total')
            ->join('tbl_anggota a', 'a.id_anggota = p.id_anggota')
            ->groupBy('p.id_anggota')
            ->orderBy('total', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | GRAFIK PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function grafikPeminjaman()
    {
        return $this->db->query("
            SELECT 
                MONTH(tgl_pinjam) as bulan,
                COUNT(*) as total
            FROM tbl_peminjaman
            WHERE YEAR(tgl_pinjam) = YEAR(CURDATE())
            GROUP BY MONTH(tgl_pinjam)
            ORDER BY bulan ASC
        ")->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | GRAFIK PENGEMBALIAN
    |--------------------------------------------------------------------------
    */

    public function grafikPengembalian()
    {
        return $this->db->query("
            SELECT 
                MONTH(tgl_pengembalian) as bulan,
                COUNT(*) as total
            FROM tbl_pengembalian
            WHERE YEAR(tgl_pengembalian) = YEAR(CURDATE())
            GROUP BY MONTH(tgl_pengembalian)
            ORDER BY bulan ASC
        ")->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | STOK MENIPIS
    |--------------------------------------------------------------------------
    */

    public function stokMenipis($limit = 5)
    {
        return $this->db->table('tbl_buku')
            ->select('judul_buku, jumlah_eksemplar')
            ->where('is_delete_buku', '0')
            ->where('jumlah_eksemplar <=', 3)
            ->orderBy('jumlah_eksemplar', 'ASC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
}