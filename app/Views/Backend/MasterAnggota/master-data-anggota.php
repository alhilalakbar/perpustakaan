<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Anggota</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Anggota
                        <a href="<?= base_url('admin/input-data-anggota');?>">
                            <button type="button" class="btn btn-sm btn-primary pull-right">Input Data Anggota</button>
                        </a>
                    </h3>
                    <hr />

                    <table 
                        data-toggle="table" 
                        data-show-refresh="true" 
                        data-show-toggle="true" 
                        data-show-columns="true" 
                        data-search="true" 
                        data-pagination="true"
                    >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; foreach($data_anggota as $data){ ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= $data['nama_anggota']; ?></td>
                                <td><?= $data['jenis_kelamin']; ?></td>
                                <td><?= $data['no_tlp']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td>
                                    <?php if(session()->get('ses_level')=="1"){ ?>
                                        <a href="<?= base_url('admin/edit-data-anggota/'.sha1($data['id_anggota']));?>">
                                            <button class="btn btn-sm btn-success">Edit</button>
                                        </a>
                                        <a href="#" onclick="hapus('<?= sha1($data['id_anggota']);?>')">
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </a>
                                    <?php } else echo "#"; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function hapus(id){
    swal({
        title : "Hapus Data Anggota?",
        text : "Data akan dihapus permanen!",
        icon : "warning",
        buttons : true
    }).then(ok => {
        if(ok){
            window.location.href = "<?= base_url('admin/hapus-data-anggota/'); ?>" + id;
        }
    })
}
</script>