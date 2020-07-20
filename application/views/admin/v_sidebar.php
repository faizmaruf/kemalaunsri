<?php 
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
$query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar = $query1->num_rows();
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li class="active">
          <a href="<?php echo base_url() . 'admin/dashboard' ?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        
        <li>
          <a href="<?php echo base_url() . 'admin/coverpage' ?>">
            <i class="fa fa-image"></i> <span>coverpage</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>Post</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="<?php echo base_url() . 'admin/tulisan' ?>"><i class="fa fa-list"></i> Post Lists</a></li>
            <li><a href="<?php echo base_url() . 'admin/kategori' ?>"><i class="fa fa-wrench"></i> Kategori</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-code"></i>
            <span>Portfolio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() . 'admin/portfolio/add_portfolio' ?>"><i class="fa fa-thumb-tack"></i> Add Portfolio</a></li>
            <li><a href="<?php echo base_url() . 'admin/portfolio' ?>"><i class="fa fa-list"></i> Portfolio List</a></li>
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url() . 'admin/pengguna' ?>">
            <i class="fa fa-user"></i> <span>Pengguna</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>



        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                
                  <li>
                    <a href="<?= base_url() . 'admin/Bph'; ?>">
                      <i class="fa fa-users"></i> <span>Data BPH</span>
                      <span class="pull-right-container">
                        <small class="label pull-right"></small>
                      </span>
                    </a>
                  </li>

                  <li>
                    <a href="<?= base_url() . 'admin/Anggota'; ?>">
                      <i class="fa fa-users"></i> <span>Data Anggota</span>
                      <span class="pull-right-container">
                        <small class="label pull-right"></small>
                      </span>
                    </a>
                  </li>

                  <li>
                    <a href="<?= base_url() . 'admin/Alumni'; ?>">
                      <i class="fa fa-users"></i> <span>Data Alumni</span>
                      <span class="pull-right-container">
                        <small class="label pull-right"></small>
                      </span>
                    </a>
                  </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-camera"></i>
            <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() . 'admin/album' ?>"><i class="fa fa-clone"></i> Album</a></li>
            <li><a href="<?php echo base_url() . 'admin/galeri' ?>"><i class="fa fa-picture-o"></i> Photos</a></li>
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url() . 'admin/komentar' ?>">
            <i class="fa fa-comment"></i> <span>Komentar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $jum_komentar; ?></small>
            </span>
          </a>
        </li>
        
        <!-- <li>
          <a href="<?php echo base_url() . 'admin/inbox' ?>">
            <i class="fa fa-envelope"></i> <span>Inbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $jum_pesan; ?></small>
            </span>
          </a>
        </li> -->

         <li>
          <a href="<?php echo base_url() . 'administrator/logout' ?>">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
