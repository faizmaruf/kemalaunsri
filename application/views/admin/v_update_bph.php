	
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


<!--Modal Edit Bph-->
<div class="modal fade" id="ModalEdit<?php echo $bph_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit bph</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/Bph/update' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xnama" value="<?php echo $bph_nama; ?>" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
                                            <input type="hidden" name="xid" value="<?php echo $bph_id; ?>"/> 
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNim" class="col-sm-4 control-label">Nim</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xnim" value="<?php echo $bph_nim; ?>" class="form-control" id="inputNim" placeholder="Nim" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAngkatan" class="col-sm-4 control-label">Angkatan</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xangkatan" value="<?php echo $bph_angkatan; ?>" class="form-control" id="inputAngkatan" placeholder="Angkatan" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJabatan" class="col-sm-4 control-label">Jabatan</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xjabatan" value="<?php echo $bph_jabatan; ?>" class="form-control" id="inputJabatan" placeholder="Jabatan" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-7">
										<?php if ($bph_jenkel == 'L') : ?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                                                <label for="inlineRadio1"> Laki-Laki </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                                                <label for="inlineRadio2"> Perempuan </label>
                                            </div>
										<?php else : ?>
											<div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="L" name="xjenkel">
                                                <label for="inlineRadio1"> Laki-Laki </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="P" name="xjenkel" checked>
                                                <label for="inlineRadio2"> Perempuan </label>
                                            </div>
										<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Fakultas</label>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="xfakultas" value="<?php echo $bph_fakultas; ?>" required>
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
                                            <input type="text" name="xinstagram" value="<?php echo $bph_instagram; ?>" class="form-control" id="inputInstagram" placeholder="Input link Instagram" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputFacebook" class="col-sm-4 control-label">Facebook</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xfacebook" value="<?php echo $bph_facebook; ?>" class="form-control" id="inputFacebook" placeholder="Input link Facebook" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                                        <div class="col-sm-7">
                                            <input type="file" name="filefoto" required/>
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
