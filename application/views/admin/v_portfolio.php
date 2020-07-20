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
function limit_words($string, $word_limit)
{
  $words = explode(" ", $string);
  return implode(" ", array_splice($words, 0, $word_limit));
}
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!--Header & SideBar-->
<?php 
$this->load->view('admin/v_header');
$this->load->view('admin/v_sidebar');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Portfolio
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Portfolio</a></li>
        <li class="active">List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" href="<?php echo base_url() . 'admin/portfolio/add_portfolio' ?>"><span class="fa fa-plus"></span> Add Portfolio</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
          					<th>Gambar</th>
          					<th>Judul</th>
          					<th>Tanggal</th>
          					<th>Author</th> 
                    <th style="text-align:right;">Aksi</th>
                </tr>
                </thead>
                <tbody>
          				<?php
              $no = 0;
              foreach ($data->result_array() as $i) :
                $no++;
              $port_id = $i['port_id'];
              $port_judul = $i['port_judul'];
              $port_isi = $i['port_deskripsi'];
              $port_tanggal = $i['tanggal'];
              $port_author = $i['port_author'];
              $port_gambar = $i['port_image'];

              ?>
                <tr>
                  <td><img src="<?php echo base_url() . 'assets/images/' . $port_gambar; ?>" style="width:90px;"></td>
                  <td><?php echo $port_judul; ?></td>
                  
        				  <td><?php echo $port_tanggal; ?></td>
        				  <td><?php echo $port_author; ?></td>
                  <td style="text-align:right;">
                        <a class="btn" href="<?php echo base_url() . 'admin/portfolio/get_edit/' . $port_id; ?>"><span class="fa fa-pencil"></span></a>
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $port_id; ?>"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
<!-- ./wrapper -->


	
	<?php foreach ($data->result_array() as $i) :
  $port_id = $i['port_id'];
$port_judul = $i['port_judul'];
$port_gambar = $i['port_image'];
?>
	<!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalHapus<?php echo $port_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Portfolio</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/portfolio/hapus_portfolio' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">       
							       <input type="hidden" name="kode" value="<?php echo $port_id; ?>"/> 
                     <input type="hidden" value="<?php echo $port_gambar; ?>" name="gambar">
                            <p>Apakah Anda yakin mau menghapus Portfolio <b><?php echo $port_judul; ?></b> ?</p>
                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	<?php endforeach; ?>
	
	


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
    
    <?php if ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Portfolio Berhasil disimpan ke database.",
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
                    text: "Portfolio berhasil di update",
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
                    text: "Portfolio Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php else : ?>

    <?php endif; ?>
</body>
</html>
