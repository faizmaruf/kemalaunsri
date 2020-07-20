<!--Counter Inbox-->
<?php 
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
$query1 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_komentar = $query1->num_rows();
?>
<!DOCTYPE html>
<html>
<?php 
$this->load->view('admin/v_head');
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!--Header & SideBar-->
  <?php 
    $this->load->view('admin/v_header');
    $this->load->view('admin/v_sidebar');
    ?>
    <head>
    <!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

<script>
$(document).ready(function(){
  // Sembunyikan alert validasi kosong
  $("#kosong").hide();
});
</script>
    </head>
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Import Data Anggota CSV
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Anggota</a></li>
        <li class="active">Import Data Anggota</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
          <div class="box">
                          <div class="box-header">
                          <a href="<?php echo base_url("csv/format.csv"); ?>" class="btn btn-primary "><span class="fa fa-download"></span> Download Format Data CSV</a>
                          </div>
                <center>
                        

              <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
              <form method="post" action="<?php echo base_url("admin/Anggota/form"); ?>" enctype="multipart/form-data">
                  <!--
                  -- Buat sebuah input type file
                  -- class pull-left berfungsi agar file input berada di sebelah kiri
                  -->
                  <input type="file" name="file" value="Pilih File">

                  <!--
                  -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
                  -->
                  <br>
                  <input type="submit" name="preview" value="Preview" class="btn btn-warning">
                </form>
                
                <?php
              if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
                if (isset($upload_error)) { // Jika proses upload gagal
                  echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
                  die; // stop skrip
                }

                  // Buat sebuah tag form untuk proses import data ke database
                echo "<form method='post' action='" . base_url('admin/Anggota/import') . "'>";

                  // Buat sebuah div untuk alert validasi kosong
                echo "<div style='color: red;' id='kosong'>
                  Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum terisi semua.
                  </div>";

                echo "<table border='1' cellpadding='8'>
                  <tr>
                    <th colspan='5'>Preview Data</th>
                  </tr>
                  <tr>
                    <th>NAMA</th>
                    <th>ANGKATAN</th>
                    <th>FAKULTAS</th>
                    <th>KONTAK</th>
                  </tr>";

                $numrow = 1;
                $kosong = 0;

                  // Lakukan perulangan dari data yang ada di csv
                  // $sheet adalah variabel yang dikirim dari controller
                foreach ($sheet as $row) {
                    // START -->
                    // Skrip untuk mengambil value nya
                  $cellIterator = $row->getCellIterator();
                  $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

                  $get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
                  foreach ($cellIterator as $cell) {
                    array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
                  }
                    // <-- END

                    // Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
                  $nama = $get[0]; // Ambil data nama
                  $angkatan = $get[1]; // Ambil data angkatan
                  $fakultas = $get[2]; // Ambil data fakultas
                  $nohp = $get[3]; // Ambil data nohp

                    // Cek jika semua data tidak diisi
                  if ($nama == "" && $angkatan == "" && $fakultas == "" && $nohp == "")
                    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                    // Cek $numrow apakah lebih dari 1
                    // Artinya karena baris pertama adalah angkatan kolom
                    // Jadi dilewat saja, tidak usah diimport
                  if ($numrow > 1) {
                      // Validasi apakah semua data telah diisi
                    $nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                    $angkatan_td = (!empty($angkatan)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                    $fakultas_td = (!empty($fakultas)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                    $nohp_td = (!empty($nohp)) ? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

                      // Jika salah satu data ada yang kosong
                    if ($nama == "" or $angkatan == "" or $fakultas == "" or $nohp == "") {
                      $kosong++; // Tambah 1 variabel $kosong
                    }

                    echo "<tr>";
                    echo "<td" . $nama_td . ">" . $nama . "</td>";
                    echo "<td" . $angkatan_td . ">" . $angkatan . "</td>";
                    echo "<td" . $fakultas_td . ">" . $fakultas . "</td>";
                    echo "<td" . $nohp_td . ">" . $nohp . "</td>";
                    echo "</tr>";
                  }

                  $numrow++; // Tambah 1 setiap kali looping
                }

                echo "</table>";

                  // Cek apakah variabel kosong lebih dari 1
                  // Jika lebih dari 1, berarti ada data yang masih kosong
                if ($kosong > 1) {
                  ?>
                    <script>
                    $(document).ready(function(){
                      // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                      $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                      $("#kosong").show(); // Munculkan alert validasi kosong
                    });
                    </script>
                  <?php

              } else { // Jika semua data sudah diisi
                echo "<hr>";

                    // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' name='import' class='btn btn-primary'>Import</button> ";
                echo "<a href='" . base_url("admin/anggota") . "' class='btn btn-danger'>Cancel</a>";
              }

              echo "</form>";
              }
              ?>


                        </center>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php 
    $this->load->view('admin/v_footer');
    ?> 

  
  <div class="control-sidebar-bg"></div>
</div>
	
	
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
<!-- page script -->    
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php if ($this->session->flashdata('msg') == 'error') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'warning') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Gambar yang Anda masukan terlalu besar.",
                    showHideTransition: 'slide',
                    icon: 'warning',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FFC017'
                });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Anggota Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Info',
                    text: "Anggota berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Anggota Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'show-modal') : ?>
        <script type="text/javascript">
                $('#ModalResetPassword').modal('show');
        </script>
    <?php else : ?>

    <?php endif; ?>
</body>
</html>