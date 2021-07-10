<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>EDIT PEMBELIAN BARANG</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-table"></i>Transaksi</li>
              <li><i class="fa fa-th-list"></i>Edit Pembelian</li>
            </ol>
<!-- Page Heading -->
<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3"> 
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/proses_edit_barangbeli/'.$databarangbeli[0]['id']); ?>">
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
                    <label for="exampleInputEmail1">Ownerku</label>
                    <input type="text" class="form-control" name="owner" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="status"  required>
                        <option selected ></option>
                        <option value="Accepted">Accepted</option>
                        <option value="Declined">Declined</option>
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