<!-- Modal -->
<div class="modal inmodal fade" id="m_tambah" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-wpforms modal-icon"></i>
                <h4 class="modal-title">Form Konsultasi</h4>
            </div>
            <div class="form-horizontal">
                <form class="form-horizontal" action="#" id="form_tambah" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-3 control-label">Nama Lengkap<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="col-sm-3 control-label">Kelas<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Kelas">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">NPM<span class="text-danger">*</span> :</label>
                            <div class="col-lg-9">
                                <input type="number" name="npm" class="form-control" id="npm" placeholder="Contoh: 5341421">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No. Telp (WA)<span class="text-danger">*</span> :</label>
                            <div class="col-lg-9">
                                <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Contoh: 08164862346">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="col-sm-3 control-label">Tujuan<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="tujuan" class="form-control" id="tujuan">
                                    <option value="">Pilih Tujuan</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Pengurus">Pengurus</option>
                                </select>
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-window-close"></i> Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="confirm_save()"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>