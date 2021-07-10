  <!--sidebar start-->
  <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="<?=base_url('dashboard')?>">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
            <a class="" href="<?=base_url('dashboard/list_user')?>">
                          <i class="icon_profile"></i>
                          <span>List User</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Transaksi</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">

              <li><a class="" href="<?=base_url('dashboard/list_barang')?>">Permohonan</a></li>
              <li><a class="" href="<?=base_url('dashboard/list_barangbeli')?>">Pembelian</a></li>
              <li><a class="" href="<?=base_url('dashboard/list_barangterima')?>">Penerimaan</a></li>
              
            </ul>
          </li>

        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->