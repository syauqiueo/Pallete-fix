<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>EDIT PERMOHONAN BARANG</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-table"></i>Master Data</li>
              <li><i class="fa fa-th-list"></i>Edit Permohonan Barang</li>
            </ol>
<!-- Page Heading -->
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_barang/'.$databarang[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="<?= set_value('tanggal',$databarang[0]['tanggal'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_brg" value="<?= set_value('nama_brg',$databarang[0]['nama_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Merk Barang</label>
                    <input type="text" class="form-control" name="merk_brg" value="<?= set_value('merk_brg',$databarang[0]['merk_brg'])?>"required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Barang</label>
                    <input type="number" class="form-control" name="jumlah_brg" value="<?= set_value('jumlah_brg',$databarang[0]['jumlah_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Barang</label>
                    <input type="number" class="form-control" name="harga_brg" value="<?= set_value('harga_brg',$databarang[0]['harga_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Total</label>
                    <input type="number" class="form-control" name="total" value="<?= set_value('total',$databarang[0]['total'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pencatat</label>
                    <input type="text" class="form-control" name="pencatat" value="<?= set_value('pencatat',$databarang[0]['pencatat'])?>" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Role</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="role" value="<?= set_value('role',$databarang[0]['role'])?>" required>
                        <option   selected ><?=$databarang[0]['role']?></option>
                        <option value="barista">Barista</option>
                        <option value="kitchen">Kitchen</option>
                    </select>
                </div>
                <br>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
        </div>
    </div>

</div>