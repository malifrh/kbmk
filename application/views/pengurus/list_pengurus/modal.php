<!-- Modal -->
<div class="modal fade" data-backdrop="false" id="m_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="form_tambah" action="#" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap">
                                <span class="help-block text-danger"></span>
                            </div>
                            <label for="npm" class="col-sm-2 control-label">NPM<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="text" name="npm" class="form-control" id="npm" placeholder="NPM">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat Tanggal lahir<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" name="ttl" class="form-control" id="ttl" placeholder="Contoh: Bogor, 16 Mei 1996">
                                <span class="help-block text-danger"></span>
                            </div>
                            <label class="col-sm-2 control-label">Nomor Handphone<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Contoh: 08123456789">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="" placeholder="Masukkan Alamat Lengkap" required>
                                <span class="help-block text-danger"></span>
                            </div>
                            <label for="email" class="col-sm-2 control-label">Email<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Contoh: google@gmail.com" required="required">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="confirm_save()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="false" id="m_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="#" id="form_edit" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" name="id_pengurus" id="id_pengurus">
                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_lengkap_" class="form-control" id="nama_lengkap_" placeholder="Nama Lengkap">
                                <span class="help-block text-danger"></span>
                            </div>
                            <label for="npm" class="col-sm-2 control-label">NPM<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="text" name="npm_" class="form-control" id="npm_" placeholder="NPM">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat Tanggal lahir<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" name="ttl_" class="form-control" id="ttl_" placeholder="Contoh: Bogor, 16 Mei 1996">
                                <span class="help-block text-danger"></span>
                            </div>
                            <label class="col-sm-2 control-label">Nomor Handphone<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" name="no_hp_" class="form-control" id="no_hp_" placeholder="Contoh: 08123456789">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat<span class="text-danger">*</span> :</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="alamat_" name="alamat_" value="" placeholder="Masukkan Alamat Lengkap" required>
                                <span class="help-block text-danger"></span>
                            </div>
                            <label for="email" class="col-sm-2 control-label">Email<span class="text-danger">*</span> :</label>
                            <div class="col-sm-4">
                                <input type="email" name="email_" class="form-control" id="email_" placeholder="Contoh: google@gmail.com" required="required">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="confirm_update()">Simpan</button>
            </div>
        </div>
    </div>
</div>