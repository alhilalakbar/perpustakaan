<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitPerpusDb extends Migration
{
    public function up()
    {
        // ==========================================
        // 1. TBL_ADMIN
        // ==========================================
        $this->forge->addField([
            'id_admin'        => ['type' => 'VARCHAR', 'constraint' => '20'],
            'nama_admin'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'username_admin'  => ['type' => 'VARCHAR', 'constraint' => '20'],
            'password_admin'  => ['type' => 'VARCHAR', 'constraint' => '255'],
            'akses_level'     => ['type' => 'ENUM', 'constraint' => ['1', '2', '3']],
            'is_delete_admin' => ['type' => 'ENUM', 'constraint' => ['0', '1']],
            'created_at'      => ['type' => 'DATETIME'],
            'updated_at'      => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('tbl_admin');

        // ==========================================
        // 2. TBL_ANGGOTA
        // ==========================================
        $this->forge->addField([
            'id_anggota'        => ['type' => 'VARCHAR', 'constraint' => '20'],
            'nama_anggota'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'jenis_kelamin'     => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'no_tlp'            => ['type' => 'VARCHAR', 'constraint' => '13'],
            'alamat'            => ['type' => 'VARCHAR', 'constraint' => '100'],
            'email'             => ['type' => 'VARCHAR', 'constraint' => '30'],
            'password_anggota'  => ['type' => 'VARCHAR', 'constraint' => '255'],
            'is_delete_anggota' => ['type' => 'ENUM', 'constraint' => ['0', '1']],
            'created_at'        => ['type' => 'DATETIME'],
            'updated_at'        => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('tbl_anggota');

        // ==========================================
        // 3. TBL_KATEGORI
        // ==========================================
        $this->forge->addField([
            'id_kategori'        => ['type' => 'VARCHAR', 'constraint' => '20'],
            'nama_kategori'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'is_delete_kategori' => ['type' => 'ENUM', 'constraint' => ['0', '1']],
            'created_at'         => ['type' => 'DATETIME'],
            'updated_at'         => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('tbl_kategori');

        // ==========================================
        // 4. TBL_RAK
        // ==========================================
        $this->forge->addField([
            'id_rak'        => ['type' => 'VARCHAR', 'constraint' => '20'],
            'nama_rak'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'is_delete_rak' => ['type' => 'ENUM', 'constraint' => ['0', '1']],
            'created_at'    => ['type' => 'DATETIME'],
            'updated_at'    => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_rak', true);
        $this->forge->createTable('tbl_rak');

        // ==========================================
        // 5. TBL_BUKU
        // ==========================================
        $this->forge->addField([
            'id_buku'          => ['type' => 'VARCHAR', 'constraint' => '20'],
            'judul_buku'       => ['type' => 'VARCHAR', 'constraint' => '200'],
            'pengarang'        => ['type' => 'VARCHAR', 'constraint' => '50'],
            'penerbit'         => ['type' => 'VARCHAR', 'constraint' => '50'],
            'tahun'            => ['type' => 'VARCHAR', 'constraint' => '4'],
            'jumlah_eksemplar' => ['type' => 'INT'],
            'id_kategori'      => ['type' => 'VARCHAR', 'constraint' => '20'],
            'keterangan'       => ['type' => 'VARCHAR', 'constraint' => '500'],
            'id_rak'           => ['type' => 'VARCHAR', 'constraint' => '20'],
            'cover_buku'       => ['type' => 'VARCHAR', 'constraint' => '30'],
            'e_book'           => ['type' => 'VARCHAR', 'constraint' => '255'],
            'is_delete_buku'   => ['type' => 'ENUM', 'constraint' => ['0', '1']],
            'created_at'       => ['type' => 'DATETIME'],
            'updated_at'       => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_buku', true);
        // Foreign Keys (field, table, referencedField, onUpdate, onDelete)
        $this->forge->addForeignKey('id_kategori', 'tbl_kategori', 'id_kategori', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_rak', 'tbl_rak', 'id_rak', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_buku');

        // ==========================================
        // 6. TBL_PEMINJAMAN
        // ==========================================
        $this->forge->addField([
            'no_peminjaman'     => ['type' => 'VARCHAR', 'constraint' => '20'],
            'id_anggota'        => ['type' => 'VARCHAR', 'constraint' => '20'],
            'tgl_pinjam'        => ['type' => 'DATE'],
            'total_pinjam'      => ['type' => 'INT'],
            'id_admin'          => ['type' => 'VARCHAR', 'constraint' => '20'],
            'status_transaksi'  => ['type' => 'ENUM', 'constraint' => ['Selesai', 'Berjalan']],
            'status_ambil_buku' => ['type' => 'ENUM', 'constraint' => ['Belum Diambil', 'Sudah Diambil']],
            'qr_code'           => ['type' => 'VARCHAR', 'constraint' => '30'],
        ]);
        $this->forge->addKey('no_peminjaman', true);
        $this->forge->addForeignKey('id_anggota', 'tbl_anggota', 'id_anggota', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_peminjaman');

        // ==========================================
        // 7. TBL_DETAIL_PEMINJAMAN
        // ==========================================
        $this->forge->addField([
            'no_peminjaman' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'id_buku'       => ['type' => 'VARCHAR', 'constraint' => '20'],
            'status_pinjam' => ['type' => 'ENUM', 'constraint' => ['Sedang Dipinjam', 'Sudah Dikembalikan']],
            'perpanjangan'  => ['type' => 'INT'],
            'tgl_kembali'   => ['type' => 'DATE'],
        ]);
        // Composite Primary Key
        $this->forge->addKey(['no_peminjaman', 'id_buku'], true);
        $this->forge->addForeignKey('id_buku', 'tbl_buku', 'id_buku', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('no_peminjaman', 'tbl_peminjaman', 'no_peminjaman', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_detail_peminjaman');

        // ==========================================
        // 8. TBL_PENGEMBALIAN
        // ==========================================
        $this->forge->addField([
            'no_pengembalian'  => ['type' => 'VARCHAR', 'constraint' => '20'],
            'no_peminjaman'    => ['type' => 'VARCHAR', 'constraint' => '20'],
            'id_buku'          => ['type' => 'VARCHAR', 'constraint' => '20'],
            'denda'            => ['type' => 'DOUBLE'],
            'tgl_pengembalian' => ['type' => 'DATE'],
            'id_admin'         => ['type' => 'VARCHAR', 'constraint' => '20'],
        ]);
        $this->forge->addKey('no_pengembalian', true);
        $this->forge->addForeignKey('id_admin', 'tbl_admin', 'id_admin', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_buku', 'tbl_buku', 'id_buku', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('no_peminjaman', 'tbl_peminjaman', 'no_peminjaman', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_pengembalian');

        // ==========================================
        // 9. TBL_TEMP_PEMINJAMAN
        // ==========================================
        $this->forge->addField([
            'id_anggota'  => ['type' => 'VARCHAR', 'constraint' => '20'],
            'id_buku'     => ['type' => 'VARCHAR', 'constraint' => '20'],
            'jumlah_temp' => ['type' => 'INT'],
        ]);
        // Composite Primary Key
        $this->forge->addKey(['id_anggota', 'id_buku'], true);
        $this->forge->addForeignKey('id_anggota', 'tbl_anggota', 'id_anggota', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_buku', 'tbl_buku', 'id_buku', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_temp_peminjaman');
    }

    public function down()
    {
        // Drop table harus dilakukan secara terbalik dari urutan pembuatan 
        // untuk menghindari error foreign key constraint
        $this->forge->dropTable('tbl_temp_peminjaman', true);
        $this->forge->dropTable('tbl_pengembalian', true);
        $this->forge->dropTable('tbl_detail_peminjaman', true);
        $this->forge->dropTable('tbl_peminjaman', true);
        $this->forge->dropTable('tbl_buku', true);
        $this->forge->dropTable('tbl_rak', true);
        $this->forge->dropTable('tbl_kategori', true);
        $this->forge->dropTable('tbl_anggota', true);
        $this->forge->dropTable('tbl_admin', true);
    }
}