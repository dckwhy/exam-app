<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('orang-tua.profile.store') }}" id="main_form"
                    enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Nama Lengkap" />
                                </div>
                                <span class="text-danger error_text name_error"></span>
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
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Foto</label>
                                        </div>
                                        <div class="col-12">
                                            <img src="" class="my-3" alt="Foto" id="img_preview" width="200px">
                                        </div>
                                    </div>
                                    <input type="hidden" id="photo_old" name="photo_old">
                                    <input type="file" class="form-control" id="photo" name="photo"
                                        onchange="previewImage()">
                                </div>
                                <span class="text-danger error_text photo_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Password Baru</label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" id="password" name="password"
                                                placeholder="Password Baru">
                                        </div>
                                        <div class="col-12">
                                            <span class="text-danger error_text password_error"></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-xs">
                                                Abaikan jika tidak ingin mengubah password</span>
                                        </div>
                                    </div>
                                </div>
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