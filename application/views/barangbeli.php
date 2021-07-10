<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST PEMBELIAN BARANG</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-table"></i>Master Data</li>
              <li><i class="fa fa-th-list"></i>List Pembelian Barang</li>
            </ol>
            <button class="btn btn-success"   type="button" data-toggle="modal" data-target="#exampleModal">
                  <i class="icon_plus"></i>
                    Tambah
                </button> 
                <br>
                <br>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">

              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Merk Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Barang</th>
                    <th>Total</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($databarangbeli as $data  => $barangbeli){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $barangbeli['id'];?></td>
                    <td><?= $barangbeli['tanggal'];?></td>
                    <td><?= $barangbeli['nama_brg'];?></td>
                    <td><?= $barangbeli['merk_brg'];?></td>
                    <td><?= $barangbeli['jumlah_brg'];?></td>
                    <td><?="Rp. ".number_format($barangbeli['harga_brg']);?></td>
                    <td><?="Rp. ".number_format($barangbeli['total']);?></td>
                    <td><?= $barangbeli['owner'];?></td>
                    <td><?= $barangbeli['status'];?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="<?= base_url('dashboard/edit_barangbeli/'.$barangbeli['id'])?>"><i class="icon_pencil"></i></a>
                        <a class="btn btn-danger" href="<?= base_url('dashboard/delete_barangbeli/'.$barangbeli['id'])?>"><i class="icon_close"></i></a>
                    </div>
                    </td>
                  </tr>
                <?php

                $no++;
                }
                ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('dashboard/create_barangbeli'); ?>">
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
                <label for="exampleInputEmail1">Owner</label>
                <input type="text" class="form-control" name="owner" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="status" required>
                    <option selected>pilih...</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Declined">Declined</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>