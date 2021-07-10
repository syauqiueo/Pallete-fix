<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i>LIST PERMOHONAN BARANG</h3>
           
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
            <div class="table-responsive">
              <table class="table">
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
                    <th>Pencatat</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>

                  <?php
                    $no = 1;
                    foreach($databarang as $data  => $barang){
                ?>

                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $barang['id'];?></td>
                    <td><?= $barang['tanggal'];?></td>
                    <td><?= $barang['nama_brg'];?></td>
                    <td><?= $barang['merk_brg'];?></td>
                    <td><?= $barang['jumlah_brg'];?></td>
                    <td><?= "Rp. ".number_format($barang['harga_brg']);?></td>
                    <td><?= "Rp. ".number_format($barang['total']);?></td>
                    <td><?= $barang['pencatat'];?></td>
                    <td><?= $barang['role'];?></td>
                    <td><?= $barang['status'];?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="<?= base_url('android/edit_barang/'.$barang['id'])?>"><i class="icon_pencil"></i></a>
                        <a class="btn btn-danger" href="<?= base_url('android/delete_barang/'.$barang['id'])?>"><i class="icon_close"></i></a>
                    </div>
                    </td>
                  </tr>
                <?php

                $no++;
                }
                ?>
                </tbody>
              </table>
            </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Permohonan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" action="<?= base_url('android/create_barang'); ?>">
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
                <label for="exampleInputEmail1">Pencatat</label>
                <input type="text" class="form-control" name="pencatat" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="role" required>
                    <option selected>pilih...</option>
                    <option value="barista">Barista</option>
                    <option value="kitchen">Kitchen</option>
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

