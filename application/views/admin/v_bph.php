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
                    Data Badan Pengurus Harian
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Bph</a></li>
                    <li class="active">Data Bph</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-user-plus"></span> Add Bph</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Nama</th>
                                                <th>Nim</th>
                                                <th>Angkatan</th>
                                                <th>Jabatan</th>
                                                <th>Fakultas</th>
                                                <th>Jenis Kelamin</th>
                                                <th style="text-align:center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data->result_array() as $i) :
                                                $bph_id = $i['bph_id'];
                                                $bph_nama = $i['bph_nama'];
                                                $bph_nim = $i['bph_nim'];
                                                $bph_angkatan = $i['bph_angkatan'];
                                                $bph_jabatan = $i['bph_jabatan'];
                                                $bph_jenkel = $i['bph_jenkel'];
                                                $bph_fakultas = $i['bph_fakultas'];
                                                $bph_photo = $i['bph_photo'];
                                            ?>
                                                <tr>
                                                    <td><img width="40" height="40" class="img-circle" src="<?php echo base_url() . 'assets/images/bph/' . $bph_photo; ?>"></td>
                                                    <td><?php echo $bph_nama; ?></td>
                                                    <td><?php echo $bph_nim; ?></td>
                                                    <td><?php echo $bph_angkatan; ?></td>
                                                    <td><?php echo $bph_jabatan; ?></td>
                                                    <td><?php echo $bph_fakultas; ?></td>
                                                    <?php if ($bph_jenkel == 'L') : ?>
                                                        <td>Laki-Laki</td>
                                                    <?php else : ?>
                                                        <td>Perempuan</td>
                                                    <?php endif; ?>
                                                    <td style="text-align:right;">

                                                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $bph_id; ?>"><span class="fa fa-pencil"></span></a>

                                                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $bph_id; ?>"><span class="fa fa-trash"></span></a>

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

    <!--Modal Add Pengguna-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Add bph</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'admin/Bph/simpan_bph' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNim" class="col-sm-4 control-label">Nim</label>
                            <div class="col-sm-7">
                                <input type="text" name="xnim" class="form-control" id="inputNim" placeholder="Nim" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAngkatan" class="col-sm-4 control-label">Angkatan</label>
                            <div class="col-sm-7">
                                <input type="text" name="xangkatan" class="form-control" id="inputAngkatan" placeholder="Angkatan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputJabatan" class="col-sm-4 control-label">Jabatan</label>
                            <div class="col-sm-7">
                                <input type="text" name="xjabatan" class="form-control" id="inputJabatan" placeholder="Jabatan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                            <div class="col-sm-7">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                                    <label for="inlineRadio1"> Laki-Laki </label>
                                </div>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                                    <label for="inlineRadio2"> Perempuan </label>
                                </div>
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
                            <label for="inputInstagram" class="col-sm-4 control-label">Instagram</label>
                            <div class="col-sm-7">
                                <input type="text" name="xinstagram" class="form-control" id="inputInstagram" placeholder="Input link Instagram" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook" class="col-sm-4 control-label">Facebook</label>
                            <div class="col-sm-7">
                                <input type="text" name="xfacebook" class="form-control" id="inputFacebook" placeholder="Input link Facebook" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                            <div class="col-sm-7">
                                <input type="file" name="filefoto" required />
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
        $bph_id = $i['bph_id'];
        $bph_nama = $i['bph_nama'];
        $bph_nim = $i['bph_nim'];
        $bph_angkatan = $i['bph_angkatan'];
        $bph_jabatan = $i['bph_jabatan'];
        $bph_jenkel = $i['bph_jenkel'];
        $bph_fakultas = $i['bph_fakultas'];
        $bph_facebook = $i['bph_facebook'];
        $bph_instagram = $i['bph_instagram'];
        $bph_photo = $i['bph_photo'];



    ?>
        <!--Modal edit Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $bph_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Add bph</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/Bph/update' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xnama" class="form-control" id="inputUserName" value="sikmik" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNim" class="col-sm-4 control-label">Nim</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xnim" class="form-control" id="inputNim" placeholder="Nim" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAngkatan" class="col-sm-4 control-label">Angkatan</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xangkatan" class="form-control" id="inputAngkatan" placeholder="Angkatan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputJabatan" class="col-sm-4 control-label">Jabatan</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xjabatan" class="form-control" id="inputJabatan" placeholder="Jabatan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                                <div class="col-sm-7">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                                        <label for="inlineRadio1"> Laki-Laki </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                                        <label for="inlineRadio2"> Perempuan </label>
                                    </div>
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
                                <label for="inputInstagram" class="col-sm-4 control-label">Instagram</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xinstagram" class="form-control" id="inputInstagram" placeholder="Input link Instagram" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputFacebook" class="col-sm-4 control-label">Facebook</label>
                                <div class="col-sm-7">
                                    <input type="text" name="xfacebook" class="form-control" id="inputFacebook" placeholder="Input link Facebook" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                                <div class="col-sm-7">
                                    <input type="file" name="filefoto" required />
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
        $bph_id = $i['bph_id'];
        $bph_nama = $i['bph_nama'];
        $bph_nim = $i['bph_nim'];
        $bph_angkatan = $i['bph_angkatan'];
        $bph_jabatan = $i['bph_jabatan'];
        $bph_jenkel = $i['bph_jenkel'];
        $bph_fakultas = $i['bph_fakultas'];
        $bph_facebook = $i['bph_facebook'];
        $bph_instagram = $i['bph_instagram'];
        $bph_photo = $i['bph_photo'];

    ?>

        <!--Modal Hapus bph-->
        <div class="modal fade" id="ModalHapus<?php echo $bph_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus bph</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/bph/hapus_bph' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="xid" value="<?php echo $bph_id; ?>" />
                            <p>Apakah Anda yakin mau menghapus bph <b><?php echo $bph_nama; ?></b> ?</p>

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
        $(function() {
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
                text: "Data BPH Berhasil disimpan ke database.",
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
                text: "Data BPH berhasil di update",
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
                text: "Data BPH Berhasil dihapus.",
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