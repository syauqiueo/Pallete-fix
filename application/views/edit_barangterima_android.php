<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>EDIT PENERIMAAN BARANG</h3>
           
<!-- Page Heading -->
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3"> 
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('android/proses_edit_barangterima/'.$databarangterima[0]['id']); ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_brg" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Merk Barang</label>
                    <input type="text" class="form-control" name="merk_brg" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Barang</label>
                    <input type="number" class="form-control" name="jumlah_brg" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Barang</label>
                    <input type="number" class="form-control" name="harga_brg" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Total</label>
                    <input type="number" class="form-control" name="total" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Penerima</label>
                    <input type="text" class="form-control" name="penerima" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="status"  required>
                        <option selected ></option>
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