<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>EDIT PENERIMAAN BARANG</h3>
           
<!-- Page Heading -->
<!-- DataTales Example -->
<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Form Edit
              </header>
              <div class="panel-body">
                <div class="form">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('android/proses_edit_barangterima/'.$databarangterima[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="<?= set_value('tanggal',$databarangterima[0]['tanggal'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_brg" value="<?= set_value('nama_brg',$databarangterima[0]['nama_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Merk Barang</label>
                    <input type="text" class="form-control" name="merk_brg" value="<?= set_value('merk_brg',$databarangterima[0]['merk_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Barang</label>
                    <input type="number" class="form-control" name="jumlah_brg" value="<?= set_value('jumlah_brg',$databarangterima[0]['jumlah_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Barang</label>
                    <input type="number" class="form-control" name="harga_brg" value="<?= set_value('harga_brg',$databarangterima[0]['harga_brg'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Total</label>
                    <input type="number" class="form-control" name="total" value="<?= set_value('total',$databarangterima[0]['total'])?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Penerima</label>
                    <input type="text" class="form-control" name="penerima" value="<?= set_value('penerima',$databarangterima[0]['penerima'])?>" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="status" value="<?= set_value('status',$databarangterima[0]['status'])?>" required>
                        <option   selected ><?=$databarangterima[0]['status']?></option>
                        <option value="Bayar Ditempat">Bayar Ditempat</option>
                        <option value="Sudah Bayar">Sudah Bayar</option>
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