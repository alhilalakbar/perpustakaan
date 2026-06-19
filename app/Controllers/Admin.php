<?php

namespace App\Controllers;

use Config\Database;
use App\Models\M_Admin;
use App\Models\M_Buku;
use App\Models\M_Kategori;
use App\Models\M_Rak;
use App\Models\M_Anggota;
use App\Models\M_Peminjaman;
use App\Models\M_Pengembalian;
use App\Models\M_Dashboard;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class Admin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function login()
    {
        return view('Backend/Login/login');
    }

    public function logout()
    {
        session()->remove('ses_id');
        session()->remove('ses_user');
        session()->remove('ses_level');
        session()->setFlashdata('info', 'Anda Berhasil Logout!');
        ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
    }

    public function dashboard()
    {
        if (
            session()->get('ses_id') == "" ||
            session()->get('ses_user') == "" ||
            session()->get('ses_level') == ""
        ) {
            session()->setFlashdata('error', 'Silahkan Login Terlebih Dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
            return;
        }

        $dashboard = new M_Dashboard();

        $data = [
            'totalAnggota' => $dashboard->totalAnggota(),
            'totalBuku' => $dashboard->totalBuku(),
            'totalKategori' => $dashboard->totalKategori(),
            'totalStok' => $dashboard->totalStok(),
            'totalDipinjam' => $dashboard->totalDipinjam(),
            'totalKembali' => $dashboard->totalDikembalikan(),
            'totalTerlambat' => $dashboard->totalTerlambat(),
            'totalDenda' => $dashboard->totalDenda(),
            'transaksiHariIni' => $dashboard->transaksiHariIni(),
            'transaksiTerbaru' => $dashboard->transaksiTerbaru(),
            'bukuPopuler' => $dashboard->bukuPopuler(),
            'anggotaAktif' => $dashboard->anggotaAktif(),
            'grafikPeminjaman' => $dashboard->grafikPeminjaman(),
            'grafikPengembalian' => $dashboard->grafikPengembalian(),
            'stokMenipis' => $dashboard->stokMenipis(),
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/Login/dashboard_admin', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function autentikasi()
    {
        $modelAdmin = new M_Admin();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cekUsername = $modelAdmin
            ->getDataAdmin([
                'username_admin' => $username,
                'is_delete_admin' => '0'
            ])
            ->getNumRows();

        if ($cekUsername == 0) {
            session()->setFlashdata('error', 'Username Tidak Ditemukan');
            ?>
<script>
history.go(-1);
</script>
<?php
        } else {

            $dataUser = $modelAdmin
                ->getDataAdmin([
                    'username_admin' => $username,
                    'is_delete_admin' => '0'
                ])
                ->getRowArray();

            $passwordUser = $dataUser['password_admin'];

            $verifikasiPassword = password_verify($password, $passwordUser);

            if (!$verifikasiPassword) {
                session()->setFlashdata('error', 'Password Tidak Sesuai!');
                ?>
<script>
history.go(-1);
</script>
<?php
            } else {

                $dataSession = [
                    'ses_id' => $dataUser['id_admin'],
                    'ses_user' => $dataUser['nama_admin'],
                    'ses_level' => $dataUser['akses_level'],
                ];

                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
<script>
document.location = "<?= base_url('admin/dashboard-admin'); ?>";
</script>
<?php
            }
        }
    }


    // input data admin
    public function input_data_admin()
    {
        if (
            session()->get('ses_id') == "" ||
            session()->get('ses_user') == "" ||
            session()->get('ses_level') == ""
        ) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {

            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterAdmin/input-admin');
            echo view('Backend/Template/footer');
        }
    }

    public function simpan_data_admin()
    {
        if (
            session()->get('ses_id') == "" ||
            session()->get('ses_user') == "" ||
            session()->get('ses_level') == ""
        ) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {

            $modelAdmin = new M_Admin();

            $nama = $this->request->getPost('nama');
            $username = $this->request->getPost('username');
            $level = $this->request->getPost('level');

            $cekUname = $modelAdmin
                ->getDataAdmin(['username_admin' => $username])
                ->getNumRows();

            if ($cekUname > 0) {
                session()->setFlashdata('error', 'Username sudah digunakan!!');
                ?>
<script>
history.go(-1);
</script>
<?php
            } else {

                $hasil = $modelAdmin->autoNumber()->getRowArray();

                if (!$hasil) {
                    $id = "ADM001";
                } else {
                    $kode = $hasil['id_admin'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;

                    $id = "ADM" . sprintf("%03s", $noUrut);
                }

                $dataSimpan = [
                    'id_admin' => $id,
                    'nama_admin' => $nama,
                    'username_admin' => $username,
                    'password_admin' => password_hash('pass_admin', PASSWORD_DEFAULT),
                    'akses_level' => $level,
                    'is_delete_admin' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $modelAdmin->saveDataAdmin($dataSimpan);

                session()->setFlashdata('success', 'Data Admin Berhasil Ditambahkan!!');
                ?>
<script>
document.location = "<?= base_url('admin/master-data-admin'); ?>";
</script>
<?php
            }
        }
    }
    public function master_data_admin()
    {
        if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            $modelAdmin = new M_Admin(); // inisiasi

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataUser = $modelAdmin->getDataAdmin(['is_delete_admin' => '0', 'akses_level !=' => '1'])->getResultArray();

            $data['pages'] = $pages;
            $data['data_user'] = $dataUser;

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterAdmin/master-data-admin', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    // edit data admin
    public function edit_data_admin()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelAdmin = new M_Admin();

        // Mengambil data admin dari table admin di database berdasarkan parameter yang dikirimkan
        $dataAdmin = $modelAdmin->getDataAdmin(['sha1(id_admin)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Admin";
        $data['data_admin'] = $dataAdmin; // mengirim array data admin ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAdmin/edit-admin', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_admin()
    {
        $modelAdmin = new M_Admin();

        $idUpdate = session()->get('idUpdate');
        $nama = $this->request->getPost('nama');
        $level = $this->request->getPost('level');

        if ($nama == "" or $level == "") {
            session()->setFlashdata('error', 'Isian tidak boleh kosong!!');
            ?>
<script>
history.go(-1);
</script>
<?php
        } else {
            $dataUpdate = [
                'nama_admin' => $nama,
                'akses_level' => $level,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $whereUpdate = ['id_admin' => $idUpdate];

            $modelAdmin->updateDataAdmin($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Admin Berhasil Diperbaharui!');
            ?>
<script>
document.location = "<?= base_url('admin/master-data-admin'); ?>";
</script>
<?php
        }
    }

    public function hapus_data_admin()
    {
        $modelAdmin = new M_Admin();

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $dataUpdate = [
            'is_delete_admin' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $whereUpdate = ['sha1(id_admin)' => $idHapus];
        $modelAdmin->updateDataAdmin($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Data Admin Berhasil Dihapus!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-admin'); ?>";
</script>
<?php
    }

    // MASTER KATEGORI
    public function master_data_kategori()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            $modelKategori = new M_Kategori();
            $data['data_kategori'] = $modelKategori->getDataKategori()->getResultArray();

            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterKategori/master-data-kategori', $data);
            echo view('Backend/Template/footer');
        }
    }

    public function input_data_kategori()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterKategori/input-kategori');
            echo view('Backend/Template/footer');
        }
    }

    public function simpan_data_kategori()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            $modelKategori = new M_Kategori();

            $nama = $this->request->getPost('nama');

            $cek = $modelKategori->getDataKategori(['nama_kategori' => $nama])->getNumRows();
            if ($cek > 0) {
                session()->setFlashdata('error', 'Kategori sudah ada!');
                ?>
<script>
history.go(-1);
</script>
<?php
            } else {
                $hasil = $modelKategori->autoNumber()->getRowArray();

                if (!$hasil) {
                    $id = "KTG001";
                } else {
                    $kode = $hasil['id_kategori'];
                    $noUrut = (int) substr($kode, -3);
                    $noUrut++;
                    $id = "KTG" . sprintf("%03s", $noUrut);
                }

                $data = [
                    'id_kategori' => $id,
                    'nama_kategori' => $nama,
                    'is_delete_kategori' => '0',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $modelKategori->saveDataKategori($data);

                session()->setFlashdata('success', 'Data berhasil ditambahkan!');
                ?>
<script>
document.location = "<?= base_url('admin/master-data-kategori'); ?>";
</script>
<?php
            }
        }
    }

    public function edit_data_kategori()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            $modelKategori = new \App\Models\M_Kategori();

            $uri = service('uri');
            $id = $uri->getSegment(3);

            $data['data_kategori'] = $modelKategori
                ->getDataKategori(['sha1(id_kategori)' => $id])
                ->getRowArray();

            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterKategori/edit-kategori', $data);
            echo view('Backend/Template/footer');
        }
    }

    public function update_data_kategori()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        } else {
            $modelKategori = new \App\Models\M_Kategori();

            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');

            $data = [
                'nama_kategori' => $nama,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $where = ['id_kategori' => $id];

            $modelKategori->updateDataKategori($data, $where);

            session()->setFlashdata('success', 'Data berhasil diupdate!');
            ?>
<script>
document.location = "<?= base_url('admin/master-data-kategori'); ?>";
</script>
<?php
        }
    }

    public function hapus_data_kategori()
    {
        $modelKategori = new M_Kategori();

        $uri = service('uri');
        $id = $uri->getSegment(3);

        $data = [
            'is_delete_kategori' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $where = ['sha1(id_kategori)' => $id];

        $modelKategori->updateDataKategori($data, $where);

        session()->setFlashdata('success', 'Data berhasil dihapus!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-kategori'); ?>";
</script>
<?php
    }

    // MASTER RAK
    public function master_data_rak()
    {
        $model = new \App\Models\M_Rak();

        $data['data_rak'] = $model
            ->getDataRak(['is_delete_rak' => '0'])
            ->getResultArray();

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterRak/master-data-rak', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_rak()
    {
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterRak/input-rak');
        echo view('Backend/Template/footer');
    }

    public function simpan_data_rak()
    {
        $model = new \App\Models\M_Rak();

        $nama = $this->request->getPost('nama');

        $cek = $model->getDataRak(['nama_rak' => $nama])->getNumRows();

        if ($cek > 0) {
            ?>
<script>
alert('Rak sudah ada');
history.go(-1);
</script>
<?php
        } else {

            $hasil = $model->autoNumber()->getRowArray();

            if (!$hasil) {
                $id = "RAK001";
            } else {
                $kode = $hasil['id_rak'];
                $no = (int) substr($kode, -3);
                $no++;
                $id = "RAK" . sprintf("%03s", $no);
            }

            $data = [
                'id_rak' => $id,
                'nama_rak' => $nama,
                'is_delete_rak' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $model->saveDataRak($data);

            ?>
<script>
document.location = "<?= base_url('admin/master-data-rak'); ?>"
</script>
<?php
        }
    }

    public function edit_data_rak()
    {
        $uri = service('uri');
        $id = $uri->getSegment(3);

        $model = new \App\Models\M_Rak();

        $dataRak = $model
            ->getDataRak(['sha1(id_rak)' => $id])
            ->getRowArray();

        session()->set(['idUpdate' => $dataRak['id_rak']]);

        $data['data_rak'] = $dataRak;

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterRak/edit-rak', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_rak()
    {
        $model = new \App\Models\M_Rak();

        $id = session()->get('idUpdate');
        $nama = $this->request->getPost('nama');

        $model->updateDataRak([
            'nama_rak' => $nama,
            'updated_at' => date('Y-m-d H:i:s')
        ], ['id_rak' => $id]);

        session()->remove('idUpdate');

        ?>
<script>
document.location = "<?= base_url('admin/master-data-rak'); ?>"
</script>
<?php
    }

    public function hapus_data_rak()
    {
        $uri = service('uri');
        $id = $uri->getSegment(3);

        $model = new \App\Models\M_Rak();

        $model->updateDataRak([
            'is_delete_rak' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ], ['sha1(id_rak)' => $id]);

        ?>
<script>
document.location = "<?= base_url('admin/master-data-rak'); ?>"
</script>
<?php
    }

    // MASTER ANGGOTA
    public function master_data_anggota()
    {
        if (session()->get('ses_id') == "" || session()->get('ses_user') == "") {
            session()->setFlashdata('error', 'Silahkan login!');
            ?>
<script>
document.location = "<?= base_url('admin/login-admin'); ?>";
</script>
<?php
        }

        $model = new \App\Models\M_Anggota();
        $data['data_anggota'] = $model->getDataAnggota()->getResultArray();

        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterAnggota/master-data-anggota', $data);
        echo view('Backend/Template/footer');
    }

    public function input_data_anggota()
    {
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterAnggota/input-anggota');
        echo view('Backend/Template/footer');
    }

    public function simpan_data_anggota()
    {
        $model = new \App\Models\M_Anggota();

        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $no_tlp = $this->request->getPost('no_tlp');
        $alamat = $this->request->getPost('alamat');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // AUTO NUMBER
        $hasil = $model->autoNumber()->getRowArray();
        if (!$hasil) {
            $id = "AGT001";
        } else {
            $kode = $hasil['id_anggota'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "AGT" . sprintf("%03s", $noUrut);
        }

        $data = [
            'id_anggota' => $id,
            'nama_anggota' => $nama,
            'jenis_kelamin' => $jk,
            'no_tlp' => $no_tlp,
            'alamat' => $alamat,
            'email' => $email,
            'password_anggota' => password_hash($password, PASSWORD_DEFAULT),
            'is_delete_anggota' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->saveDataAnggota($data);

        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-anggota'); ?>";
</script>
<?php
    }

    public function edit_data_anggota()
    {
        $uri = service('uri');
        $id = $uri->getSegment(3);

        $model = new \App\Models\M_Anggota();
        $data['data_anggota'] = $model->getDataAnggota(['sha1(id_anggota)' => $id])->getRowArray();

        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterAnggota/edit-anggota', $data);
        echo view('Backend/Template/footer');
    }

    public function update_data_anggota()
    {
        $model = new \App\Models\M_Anggota();

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $jk = $this->request->getPost('jk');
        $no_tlp = $this->request->getPost('no_tlp');
        $alamat = $this->request->getPost('alamat');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = [
            'nama_anggota' => $nama,
            'jenis_kelamin' => $jk,
            'no_tlp' => $no_tlp,
            'alamat' => $alamat,
            'email' => $email,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!empty($password)) {
            $data['password_anggota'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->updateDataAnggota($data, ['id_anggota' => $id]);

        session()->setFlashdata('success', 'Data berhasil diupdate!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-anggota'); ?>";
</script>
<?php
    }

    public function hapus_data_anggota()
    {
        $model = new \App\Models\M_Anggota();
        $uri = service('uri');
        $id = $uri->getSegment(3);

        $data = [
            'is_delete_anggota' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->updateDataAnggota($data, ['sha1(id_anggota)' => $id]);

        session()->setFlashdata('success', 'Data berhasil dihapus!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-anggota'); ?>";
</script>
<?php
    }


    // MASTER BUKU
    public function master_buku()
    {
        $modelBuku = new M_Buku();
        // Mengambil data keseluruhan buku dari table buku di database
        $dataBuku = $modelBuku->getDataBukuJoin(['tbl_buku.is_delete_buku' => '0'])->getResultArray();

        $uri = service('uri');
        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Master Data Buku";
        $data['dataBuku'] = $dataBuku; // mengirim array data buku ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/master-data-buku', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_buku()
    {
        $modelKategori = new M_Kategori();
        $modelRak = new M_Rak();
        $uri = service('uri');
        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Input Data Buku";
        $data['data_kategori'] = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
        $data['data_rak'] = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/input-buku', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function simpan_buku()
    {
        $modelBuku = new M_Buku();

        // Mengambil data dari inputan form
        $judulBuku = $this->request->getPost('judul_buku');
        $pengarang = $this->request->getPost('pengarang');
        $penerbit = $this->request->getPost('penerbit');
        $tahun = $this->request->getPost('tahun');
        $jumlahEksemplar = $this->request->getPost('jumlah_eksemplar');
        $kategoriBuku = $this->request->getPost('kategori_buku');
        $keterangan = $this->request->getPost('keterangan');
        $rak = $this->request->getPost('rak');

        // 1. Validasi File Cover Buku
        if (
            !$this->validate([
                'cover_buku' => 'uploaded[cover_buku]|max_size[cover_buku, 1024]|ext_in[cover_buku,jpg,jpeg,png]',
            ])
        ) {
            session()->setFlashdata('error', "Format file yang diizinkan : jpg, jpeg, png dengan maksimal ukuran 1 MB");
            return redirect()->to('/admin/input-buku')->withInput();
        }

        // 2. Validasi File E-Book
        if (
            !$this->validate([
                'e_book' => 'uploaded[e_book]|max_size[e_book, 10240]|ext_in[e_book,pdf]',
            ])
        ) {
            session()->setFlashdata('error', "Format file yang diizinkan : pdf dengan maksimal ukuran 10 MB");
            return redirect()->to('/admin/input-buku')->withInput();
        }

        // 3. Proses Upload Cover Buku
        $coverBuku = $this->request->getFile('cover_buku');
        $ext1 = $coverBuku->getClientExtension();
        $namaFile1 = "Cover-Buku-" . date("ymdHis") . "." . $ext1;
        $coverBuku->move('Assets/CoverBuku', $namaFile1);

        // 4. Proses Upload E-Book
        $eBook = $this->request->getFile('e_book');
        $ext2 = $eBook->getClientExtension();
        $namaFile2 = "E-Book-" . date("ymdHis") . "." . $ext2;
        $eBook->move('Assets/E-Book', $namaFile2);

        // 5. Pembuatan ID Buku Otomatis
        $hasil = $modelBuku->autoNumber()->getRowArray();
        if (!$hasil) {
            $id = "BKU001";
        } else {
            $kode = $hasil['id_buku'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "BKU" . sprintf("%03s", $noUrut);
        }

        // 6. Menyusun Data untuk Disimpan
        $dataSimpan = [
            'id_buku' => $id,
            'judul_buku' => ucwords($judulBuku),
            'pengarang' => ucwords($pengarang),
            'penerbit' => ucwords($penerbit),
            'tahun' => $tahun,
            'jumlah_eksemplar' => $jumlahEksemplar,
            'id_kategori' => $kategoriBuku,
            'keterangan' => $keterangan,
            'id_rak' => $rak,
            'cover_buku' => $namaFile1,
            'e_book' => $namaFile2,
            'is_delete_buku' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // 7. Eksekusi Simpan dan Redireksi
        $modelBuku->saveDataBuku($dataSimpan);
        session()->setFlashdata('success', 'Data Buku Berhasil Diperbaharui!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-buku'); ?>";
</script>
<?php
    }

    public function hapus_buku($id)
    {
        $modelBuku = new M_Buku();

        $dataUpdate = [
            'is_delete_buku' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $modelBuku->updateDataBuku($dataUpdate, ['id_buku' => $id]);

        session()->setFlashdata('success', 'Data Buku Berhasil Dihapus!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-buku'); ?>";
</script>
<?php
    }

    public function edit_buku($id)
    {
        $modelBuku = new M_Buku();
        $modelKategori = new M_Kategori();
        $modelRak = new M_Rak();

        $dataBuku = $modelBuku->getDataBuku(['id_buku' => $id])->getRowArray();

        if (!$dataBuku) {
            session()->setFlashdata('error', 'Data tidak ditemukan!');
            return redirect()->to('admin/master-data-buku');
        }

        $data['dataBuku'] = $dataBuku;
        $data['data_kategori'] = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
        $data['data_rak'] = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterBuku/edit-buku', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_buku()
    {
        $modelBuku = new M_Buku();

        $id = $this->request->getPost('id_buku');
        $dataLama = $modelBuku->getDataBuku(['id_buku' => $id])->getRowArray();

        $cover = $this->request->getFile('cover_buku');
        $ebook = $this->request->getFile('e_book');

        // COVER
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $ext = $cover->getClientExtension();
            $namaCover = "Cover-Buku-" . date("ymdHis") . "." . $ext;
            $cover->move('Assets/CoverBuku', $namaCover);

            if (file_exists('Assets/CoverBuku/' . $dataLama['cover_buku'])) {
                unlink('Assets/CoverBuku/' . $dataLama['cover_buku']);
            }
        } else {
            $namaCover = $dataLama['cover_buku'];
        }

        // EBOOK
        if ($ebook && $ebook->isValid() && !$ebook->hasMoved()) {
            $ext2 = $ebook->getClientExtension();
            $namaEbook = "E-Book-" . date("ymdHis") . "." . $ext2;
            $ebook->move('Assets/E-Book', $namaEbook);

            if (file_exists('Assets/E-Book/' . $dataLama['e_book'])) {
                unlink('Assets/E-Book/' . $dataLama['e_book']);
            }
        } else {
            $namaEbook = $dataLama['e_book'];
        }

        $dataUpdate = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun' => $this->request->getPost('tahun'),
            'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
            'id_kategori' => $this->request->getPost('kategori_buku'),
            'id_rak' => $this->request->getPost('rak'),
            'keterangan' => $this->request->getPost('keterangan'),
            'cover_buku' => $namaCover,
            'e_book' => $namaEbook,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $modelBuku->updateDataBuku($dataUpdate, ['id_buku' => $id]);

        session()->setFlashdata('success', 'Data Buku Berhasil Diupdate!');
        ?>
<script>
document.location = "<?= base_url('admin/master-data-buku'); ?>";
</script>
<?php
    }

    // Akhir Modul Buku

    // MODUL PEMINJAMAN
    public function peminjaman_step1()
    {
        $modelAnggota = new M_Anggota();

        $uri = service('uri');

        $data = [
            'page' => $uri->getSegment(2),
            'web_title' => "Transaksi Peminjaman",
            'anggota' => $modelAnggota->getDataAnggota([
                'is_delete_anggota' => '0'
            ])->getResultArray()
        ];

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/Transaksi/peminjaman-step-1', $data)
            . view('Backend/Template/footer', $data);
    }

    public function peminjaman_step2()
    {
        $modelAnggota = new M_Anggota();
        $modelBuku = new M_Buku();
        $modelPeminjaman = new M_Peminjaman();

        $uri = service('uri');
        $page = $uri->getSegment(2);

        // ambil id anggota
        $idAnggota = $this->request->getPost('id_anggota');

        if (!empty($idAnggota)) {
            session()->set('idAgt', $idAnggota);
        } else {
            $idAnggota = session()->get('idAgt');
        }

        if (empty($idAnggota)) {
            session()->setFlashdata('error', 'ID anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/peminjaman-step-1'));
        }

        // validasi anggota
        $dataAnggota = $modelAnggota->getDataAnggota([
            'id_anggota' => $idAnggota
        ])->getRowArray();

        if (!$dataAnggota) {
            session()->remove('idAgt');
            session()->setFlashdata('error', 'Anggota tidak ditemukan.');
            return redirect()->to(base_url('admin/peminjaman-step-1'));
        }

        // ambil data temp
        $dataTemp = $modelPeminjaman->getDataTempJoin([
            'tbl_temp_peminjaman.id_anggota' => $idAnggota
        ])->getResultArray();

        $jumlahTemp = $modelPeminjaman->getDataTemp([
            'id_anggota' => $idAnggota
        ])->getNumRows();

        // hanya cek pinjaman aktif jika keranjang kosong
        if ($jumlahTemp == 0) {
            $cekPeminjaman = $modelPeminjaman->getDataPeminjaman([
                'id_anggota' => $idAnggota,
                'status_transaksi' => 'Berjalan'
            ])->getNumRows();

            if ($cekPeminjaman > 0) {
                session()->setFlashdata(
                    'error',
                    'Masih ada transaksi peminjaman yang belum selesai.'
                );

                return redirect()->to(base_url('admin/peminjaman-step-1'));
            }
        }

        $dataBuku = $modelBuku->getDataBukuJoin([
            'tbl_buku.is_delete_buku' => '0'
        ])->getResultArray();

        $data = [
            'page' => $page,
            'web_title' => 'Transaksi Peminjaman',
            'dataAnggota' => $dataAnggota,
            'dataBuku' => $dataBuku,
            'dataTemp' => $dataTemp,
            'jumlahTemp' => $jumlahTemp
        ];

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/Transaksi/peminjaman-step-2', $data)
            . view('Backend/Template/footer', $data);
    }
    public function simpan_temp_pinjam()
    {
        $modelPeminjaman = new M_Peminjaman();
        $modelBuku = new M_Buku();

        // pastikan session anggota ada
        $idAnggota = session()->get('idAgt');

        if (!$idAnggota) {
            session()->setFlashdata('error', 'Session anggota hilang, silakan pilih anggota lagi.');
            return redirect()->to(base_url('admin/peminjaman-step-1'));
        }

        $uri = service('uri');
        $idBukuHash = $uri->getSegment(3);

        // ambil data buku
        $dataBuku = $modelBuku->getDataBuku([
            'sha1(id_buku)' => $idBukuHash
        ])->getRowArray();

        if (!$dataBuku) {
            session()->setFlashdata('error', 'Data buku tidak ditemukan.');
            return redirect()->back();
        }

        // cek buku yg sama di keranjang anggota yg sama
        $adaTemp = $modelPeminjaman->getDataTemp([
            'sha1(id_buku)' => $idBukuHash,
            'id_anggota' => $idAnggota
        ])->getNumRows();

        if ($adaTemp > 0) {
            session()->setFlashdata(
                'error',
                'Buku ini sudah ada di keranjang peminjaman.'
            );

            return redirect()->to(base_url('admin/peminjaman-step-2'));
        }

        // cek stok
        if ((int) $dataBuku['jumlah_eksemplar'] <= 0) {
            session()->setFlashdata('error', 'Stok buku habis.');
            return redirect()->to(base_url('admin/peminjaman-step-2'));
        }

        // simpan temp
        $dataSimpanTemp = [
            'id_anggota' => $idAnggota,
            'id_buku' => $dataBuku['id_buku'],
            'jumlah_temp' => 1
        ];

        $modelPeminjaman->saveDataTemp($dataSimpanTemp);

        // update stok
        $stokBaru = (int) $dataBuku['jumlah_eksemplar'] - 1;

        $modelBuku->updateDataBuku([
            'jumlah_eksemplar' => $stokBaru
        ], [
            'id_buku' => $dataBuku['id_buku']
        ]);

        session()->setFlashdata('success', 'Buku berhasil ditambahkan.');

        return redirect()->to(base_url('admin/peminjaman-step-2'));
    }

    public function hapus_peminjaman()
    {
        // Inisialisasi model yang diperlukan
        $modelPeminjaman = new M_Peminjaman();
        $modelBuku = new M_Buku();

        // Mengambil ID Buku dari segment URI ke-3
        $uri = service('uri');
        $idBuku = $uri->getSegment(3);

        // Mengambil data buku berdasarkan hash SHA1 id_buku untuk mendapatkan stok saat ini
        $dataBuku = $modelBuku->getDataBuku(['sha1(id_buku)' => $idBuku])->getRowArray();

        if ($dataBuku) {
            // 1. Menghapus data dari tabel temporary berdasarkan ID Buku dan ID Anggota di session
            $whereHapus = [
                'sha1(id_buku)' => $idBuku,
                'id_anggota' => session()->get('idAgt')
            ];
            $modelPeminjaman->hapusDataTemp($whereHapus);

            // 2. Mengembalikan stok buku (tambah 1)
            $stok = $dataBuku['jumlah_eksemplar'] + 1;
            $dataUpdate = [
                'jumlah_eksemplar' => $stok
            ];
            $modelBuku->updateDataBuku($dataUpdate, ['sha1(id_buku)' => $idBuku]);

            // Berikan pesan sukses melalui flashdata
            session()->setFlashdata('success', 'Buku berhasil dihapus dari daftar pinjam dan stok telah dikembalikan.');
        }

        // 3. Redirect kembali ke halaman peminjaman step 2 menggunakan cara native CI4
        return redirect()->to(base_url('admin/peminjaman-step-2'));
    }

    public function simpan_transaksi_peminjaman()
    {
        $modelPeminjaman = new M_Peminjaman();

        // Menghasilkan ID Peminjaman berdasarkan timestamp (TahunBulanTanggalJamMenitDetik)
        $idPeminjaman = date("ymdHis");
        $time_sekarang = time();

        // Tanggal kembali otomatis 7 hari dari sekarang
        $kembali = date("Y-m-d", strtotime("+7 days", $time_sekarang));

        // Mengambil jumlah item yang ada di tabel temporary berdasarkan ID Anggota di session
        $jumlahPinjam = $modelPeminjaman->getDataTemp([
            'id_anggota' => session()->get('idAgt')
        ])->getNumRows();

        // --- PROSES GENERATE QR CODE ---
        $dataQR = $idPeminjaman;
        $labelQR = $idPeminjaman;

        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($dataQR)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->logoPath(FCPATH . 'Assets/logo_ubsi.png')
            ->logoResizeToWidth(50)
            ->logoPunchoutBackground(true)
            ->labelText($labelQR)
            ->labelFont(new NotoSans(20))
            ->labelAlignment(LabelAlignment::Center)
            ->validateResult(false)
            ->build();

        // 1. Simpan gambar QR Code ke folder Assets
        $namaQR = "qr_" . $idPeminjaman . ".png";
        $result->saveToFile(FCPATH . 'Assets/qr_code/' . $namaQR);

        // 2. Output langsung ke browser (Opsional, tergantung kebutuhan alur aplikasi Anda)
        // Jika Anda ingin lanjut ke proses database, bagian header ini mungkin perlu disesuaikan
        header('Content-Type: ' . $result->getMimeType());
        echo $result->getString();
        // 1. Menyiapkan data untuk tabel induk peminjaman
        $dataSimpan = [
            'no_peminjaman' => $idPeminjaman,
            'id_anggota' => session()->get('idAgt'),
            'tgl_pinjam' => date("Y-m-d"),
            'total_pinjam' => $jumlahPinjam,
            'id_admin' => '-', // Bisa diisi dengan ID admin yang login jika ada
            'status_transaksi' => "Berjalan",
            'status_ambil_buku' => "Sudah Diambil",
            'qr_code' => $namaQR,
        ];
        $modelPeminjaman->saveDataPeminjaman($dataSimpan);

        // 2. Mengambil semua data dari tabel temporary untuk dipindahkan ke detail
        $dataTemp = $modelPeminjaman->getDataTemp(['id_anggota' => session()->get('idAgt')])->getResultArray();

        foreach ($dataTemp as $sementara) {
            $simpanDetail = [
                'no_peminjaman' => $idPeminjaman,
                'id_buku' => $sementara['id_buku'],
                'status_pinjam' => "Sedang Dipinjam",
                'perpanjangan' => "2",
                'tgl_kembali' => $kembali
            ];
            $modelPeminjaman->saveDataDetail($simpanDetail);
        }

        // 3. Membersihkan data temporary dan session setelah berhasil disimpan
        $modelPeminjaman->hapusDataTemp(['id_anggota' => session()->get('idAgt')]);
        session()->remove('idAgt');

        // 4. Set pesan sukses dan redirect ke halaman data transaksi
        session()->setFlashdata('success', 'Data Peminjaman Buku Berhasil Disimpan!');

        return redirect()->to(base_url('admin/data-transaksi-peminjaman'));
    }

    public function data_transaksi_peminjaman()
    {
        $modelPeminjaman = new M_Peminjaman();
        $uri = service('uri');

        // Mengambil semua data peminjaman dengan join ke tabel anggota
        $dataPeminjaman = $modelPeminjaman->getDataPeminjamanJoin()->getResultArray();

        $data = [
            'page' => $uri->getSegment(2),
            'web_title' => "Data Transaksi Peminjaman",
            'dataPeminjaman' => $dataPeminjaman
        ];

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/Transaksi/data_peminjaman', $data)
            . view('Backend/Template/footer', $data);
    }

    public function detail_peminjaman($noPeminjaman)
    {
        $modelPeminjaman = new M_Peminjaman();

        $uri = service('uri');

        // Data transaksi utama
        $dataPeminjaman = $modelPeminjaman
            ->getDataPeminjamanJoin([
                'no_peminjaman' => $noPeminjaman
            ])
            ->getRowArray();

        // Detail buku yang dipinjam
        $detailPeminjaman = $modelPeminjaman
            ->getDetailPeminjaman([
                'no_peminjaman' => $noPeminjaman
            ])
            ->getResultArray();

        $data = [
            'page' => $uri->getSegment(2),
            'web_title' => 'Detail Peminjaman',
            'dataPeminjaman' => $dataPeminjaman,
            'detailPeminjaman' => $detailPeminjaman
        ];

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/Transaksi/detail_peminjaman', $data)
            . view('Backend/Template/footer', $data);
    }

    // ==================== DATA PENGEMBALIAN ====================

    public function data_transaksi_pengembalian()
    {
        $modelPengembalian = new M_Pengembalian();

        $uri = service('uri');

        $dataPengembalian = $modelPengembalian
            ->getDataPengembalianJoin()
            ->getResultArray();

        $data = [
            'page' => $uri->getSegment(2),
            'web_title' => 'Data Pengembalian',
            'dataPengembalian' => $dataPengembalian
        ];

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/Transaksi/data_pengembalian', $data)
            . view('Backend/Template/footer', $data);
    }

    // ==================== PROSES PENGEMBALIAN ====================

    public function proses_pengembalian($noPeminjaman, $idBuku)
    {
        $modelPengembalian = new M_Pengembalian();
        $modelPeminjaman = new M_Peminjaman();
        $modelBuku = new M_Buku();

        // AMBIL DATA BUKU
        $dataBuku = $modelBuku
            ->getDataBuku([
                'id_buku' => $idBuku
            ])
            ->getRowArray();

        // AMBIL DETAIL PEMINJAMAN
        $detail = \db_connect()->table('tbl_detail_peminjaman')
            ->where([
                'no_peminjaman' => $noPeminjaman,
                'id_buku' => $idBuku
            ])
            ->get()
            ->getRowArray();

        // NOMOR PENGEMBALIAN
        $noPengembalian = "PGM" . date("ymdHis") . rand(100, 999);

        // HITUNG DENDA
        $today = date('Y-m-d');

        $tglKembali = $detail['tgl_kembali'];

        $denda = 0;

        if ($today > $tglKembali) {

            $hariTerlambat =
                (strtotime($today) - strtotime($tglKembali))
                / (60 * 60 * 24);

            $denda = $hariTerlambat * 1000;
        }

        // SIMPAN DATA PENGEMBALIAN
        $dataSimpan = [
            'no_pengembalian' => $noPengembalian,
            'no_peminjaman' => $noPeminjaman,
            'id_buku' => $idBuku,
            'denda' => $denda,
            'tgl_pengembalian' => date('Y-m-d'),
            'id_admin' => 'ADM001'
        ];

        $modelPengembalian->saveDataPengembalian($dataSimpan);

        // UPDATE STATUS DETAIL PEMINJAMAN
        $modelPeminjaman->updateDataDetail(
            [
                'status_pinjam' => 'Sudah Dikembalikan'
            ],
            [
                'no_peminjaman' => $noPeminjaman,
                'id_buku' => $idBuku
            ]
        );

        // CEK APAKAH MASIH ADA BUKU DIPINJAM
        $cek = \db_connect()->table('tbl_detail_peminjaman')
            ->where([
                'no_peminjaman' => $noPeminjaman,
                'status_pinjam' => 'sedang dipinjam'
            ])
            ->countAllResults();

        // JIKA SUDAH SEMUA DIKEMBALIKAN
        if ($cek == 0) {

            $modelPeminjaman->updateDataPeminjaman(
                [
                    'status_transaksi' => 'Selesai'
                ],
                [
                    'no_peminjaman' => $noPeminjaman
                ]
            );
        }

        // KEMBALIKAN STOK BUKU
        $stokBaru = $dataBuku['jumlah_eksemplar'] + 1;

        $modelBuku->updateDataBuku(
            [
                'jumlah_eksemplar' => $stokBaru
            ],
            [
                'id_buku' => $idBuku
            ]
        );

        session()->setFlashdata(
            'success',
            'Buku berhasil dikembalikan'
        );

        return redirect()->back();
    }

    public function laporan()
    {
        $data = [
            'dataBuku' => $this->db->table('tbl_buku')->get()->getResultArray(),
            'dataAnggota' => $this->db->table('tbl_anggota')->get()->getResultArray(),
            'dataPeminjaman' => $this->db->table('tbl_peminjaman')->get()->getResultArray(),
            'dataPengembalian' => $this->db->table('tbl_pengembalian')->get()->getResultArray(),
        ];

        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/Laporan/laporan', $data);
        echo view('Backend/Template/footer');
    }

    public function cetakLaporanBuku()
    {
        $data['dataBuku'] = $this->db->table('tbl_buku')->get()->getResultArray();

        return view('Backend/Laporan/cetak_buku', $data);
    }

    public function cetakLaporanAnggota()
    {
        $data['dataAnggota'] = $this->db->table('tbl_anggota')->get()->getResultArray();

        return view('Backend/Laporan/cetak_anggota', $data);
    }

    public function cetakLaporanPeminjaman()
    {
        $data['dataPeminjaman'] = $this->db->table('tbl_peminjaman')
            ->select('tbl_peminjaman.*, tbl_anggota.nama_anggota')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
            ->get()
            ->getResultArray();

        return view('Backend/Laporan/cetak_peminjaman', $data);
    }

    public function cetakLaporanPengembalian()
    {
        $data['dataPengembalian'] = $this->db->table('tbl_pengembalian')->get()->getResultArray();

        return view('Backend/Laporan/cetak_pengembalian', $data);
    }
}