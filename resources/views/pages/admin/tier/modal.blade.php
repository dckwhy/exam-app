<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.tingkat.store') }}" id="main_form"
                    method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="text" id="price" class="form-control" name="price"
                                        placeholder="Harga" />
                                </div>
                                <span class="text-danger error_text name_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="price">Alasan</label>
                                    <textarea class="form-control" name="reason" id="reason" cols="30" rows="10" placeholder="Alasan perubahan harga..."></textarea>
                                </div>
                                <span class="text-danger error_text name_error"></span>
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