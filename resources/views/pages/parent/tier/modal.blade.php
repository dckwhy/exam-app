<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('orang-tua.anak.payment') }}" id="main_form"
                    enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="proof_of_payment">Bukti Pembayaran</label>
                                    <input type="file" id="proof_of_payment" class="form-control"
                                        name="proof_of_payment" placeholder="Bukti Pembayaran" />
                                </div>
                                <div class="row">
                                    <span class="text-info col-12">Max File 2 MB</span>
                                    <span class="text-danger col-12 error_text proof_of_payment_error"></span>
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