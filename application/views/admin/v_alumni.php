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
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Alumni
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alumni</a></li>
        <li class="active">Data Alumni</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-user-plus"></span> Add Alumni</a>          
              <a href="<?php echo base_url() . 'admin/Alumni/form' ?>" class="btn btn-secondary btn-flat" ><span class="fa fa-download"></span> Import data CSV</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Fakultas</th>
                    <th>Kontak</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($data->result_array() as $i) :
        $alumni_id = $i['alumni_id'];
    $alumni_nama = $i['alumni_nama'];
    $alumni_angkatan = $i['alumni_angkatan'];
    $alumni_fakultas = $i['alumni_fakultas'];
    $alumni_nohp = $i['alumni_nohp'];
    ?>
                <tr>
                  
                  <td><?php echo $alumni_nama; ?></td>
                  <td><?php echo $alumni_angkatan; ?></td>
                  <td><?php echo $alumni_fakultas; ?></td>
                  <td><?php echo $alumni_nohp; ?></td>
                  <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $alumni_id; ?>"><span class="fa fa-pencil"></span></a>
                  
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $alumni_id; ?>"><span class="fa fa-trash"></span></a>
                        
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

<!--Modal Add Alumni-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="mo`dal-title" id="myModalLabel">Add data Alumni</h4>
                    </div>
                    
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/Alumni/simpan_alumni' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAngkatan3" class="col-sm-4 control-label">Angkatan</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xangkatan" class="form-control" id="inputAngkatan3" placeholder="Angkatan" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Fakultas</label>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="xfakultas" required>
                                                <option value="FE">FE</option>
                                                <option value="FH">FH</option>
                                                <option value="FT">FT</option>
                                                <option value="FK">FK</option>
                                                <option value="FP">FP</option>
                                                <option value="FKIP">FKIP</option>
                                                <option value="FISIP">FISIP</option>
                                                <option value="FMIPA">FMIPA</option>
                                                <option value="FASILKOM">FASILKOM</option>
                                                <option value="FKM">FKM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Kontak Person</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xkontak" class="form-control" id="inputUserName" placeholder="Kontak Person" required>
                                        </div>
                                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
		
		
		<?php foreach ($data->result_array() as $i) :
        $alumni_id = $i['alumni_id'];
    $alumni_nama = $i['alumni_nama'];
    $alumni_angkatan = $i['alumni_angkatan'];
    $alumni_fakultas = $i['alumni_fakultas'];
    $Alumni_nohp = $i['alumni_nohp'];
    ?>
	<!--Modal Edit Alumni-->
    <div class="modal fade" id="ModalEdit<?php echo $alumni_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Alumni</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/Alumni/update_alumni' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="hidden" name="xid" value="<?php echo $alumni_id; ?>"/>
                                            <input type="text" name="xnama" class="form-control" value="<?= $alumni_nama; ?>" id="inputUserName" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAngkatan3" class="col-sm-4 control-label">Angkatan</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xangkatan" class="form-control" value="<?= $alumni_angkatan; ?>"  id="inputAngkatan3" placeholder="Angkatan" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Fakultas</label>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="xfakultas" required value="<?= $alumni_fakultas; ?>" >
                                                <option value="FE">FE</option>
                                                <option value="FH">FH</option>
                                                <option value="FT">FT</option>
                                                <option value="FK">FK</option>
                                                <option value="FP">FP</option>
                                                <option value="FKIP">FKIP</option>
                                                <option value="FISIP">FISIP</option>
                                                <option value="FMIPA">FMIPA</option>
                                                <option value="FASILKOM">FASILKOM</option>
                                                <option value="FKM">FKM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Kontak Person</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xkontak" class="form-control" value="<?= $alumni_nohp; ?>"  id="inputUserName" placeholder="Kontak Person" required>
                                        </div>
                                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
		<?php endforeach; ?>
        
		<?php foreach ($data->result_array() as $i) :
        $alumni_id = $i['alumni_id'];
    $alumni_nama = $i['alumni_nama'];
    $alumni_angkatan = $i['alumni_angkatan'];
    $alumni_fakultas = $i['alumni_fakultas'];
    $Alumni_nohp = $i['alumni_nohp'];
    ?>
	<!--Modal Hapus Alumni-->
        <div class="modal fade" id="ModalHapus<?php echo $alumni_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Alumni</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/Alumni/hapus_alumni' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">       
							<input type="hidden" name="xid" value="<?php echo $alumni_id; ?>"/> 
                            <p>Apakah Anda yakin mau menghapus Alumni <b><?php echo $alumni_nama; ?></b> ?</p>
                            
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
                    text: "Alumni Berhasil disimpan ke database.",
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
                    text: "Alumni berhasil di update",
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
                    text: "Alumni Berhasil dihapus.",
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