<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Kategori</li>
            <li class="active">Edit Data Kategori</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Kategori</h3>
                    <hr />
                    <form action="<?= base_url('admin/update-data-kategori');?>" method="post">

                        <input type="hidden" name="id" value="<?= $data_kategori['id_kategori']; ?>">

                        <div class="form-group col-md-6">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="nama" value="<?= $data_kategori['nama_kategori']; ?>" required="required">
                        </div>

                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                        </div>

                        <div style="clear:both;"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>