<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('orang-tua.anak.store') }}" id="main_form"
                    method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="student_id" id="student_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Nama Lengkap" />
                                </div>
                                <span class="text-danger error_text name_error"></span>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="place_of_birth">Tempat Lahir</label>
                                    <input type="text" id="place_of_birth" class="form-control" name="place_of_birth"
                                        placeholder="Tempat Lahir" />
                                </div>
                                <span class="text-danger error_text place_of_birth_error"></span>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Tanggal Lahir</label>
                                    <input type="date" id="date_of_birth" class="form-control" name="date_of_birth"
                                        placeholder="Tanggal Lahir" />
                                </div>
                                <span class="text-danger error_text date_of_birth_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="Male">Laki Laki</option>
                                        <option value="Female">Perempuan</option>
                                    </select>
                                </div>
                                <span class="text-danger error_text gender_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Email" />
                                </div>
                                <span class="text-danger error_text email_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone">No Telepon</label>
                                    <input type="number" id="phone" class="form-control" name="phone"
                                        placeholder="No Telepon" />
                                </div>
                                <span class="text-danger error_text phone_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" id="address" class="form-control" name="address"
                                        placeholder="Alamat" />
                                </div>
                                <span class="text-danger error_text address_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="school_origin">Asal Sekolah</label>
                                    <input type="text" id="school_origin" class="form-control" name="school_origin"
                                        placeholder="Asal Sekolah" />
                                </div>
                                <span class="text-danger error_text school_origin_error"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="fa fa-times"></i>
                                    Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>