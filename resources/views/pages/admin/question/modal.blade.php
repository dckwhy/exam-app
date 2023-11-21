<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.pertanyaan.store') }}" id="main_form"
                    method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="try_out_id" id="try_out_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="question">Pertanyaan</label>
                                    <input type="text" id="question" class="form-control" name="question"
                                        placeholder="Pertanyaan" />
                                </div>
                                <span class="text-danger col-12 error_text question_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="answer">Jawaban</label>
                                    <input type="text" id="answer" class="form-control" name="answer"
                                        placeholder="Jawaban" />
                                </div>
                                <span class="text-danger col-12 error_text answer_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="options">Pilhan 1</label>
                                    <input type="text" id="options" class="form-control" name="options[]"
                                        placeholder="Pilhan 1" />
                                </div>
                                <span class="text-danger col-12 error_text options.0_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="options">Pilhan 2</label>
                                    <input type="text" id="options" class="form-control" name="options[]"
                                        placeholder="Pilhan 2" />
                                </div>
                                <span class="text-danger col-12 error_text options.1_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="options">Pilhan 3</label>
                                    <input type="text" id="options" class="form-control" name="options[]"
                                        placeholder="Pilhan 3" />
                                </div>
                                <span class="text-danger col-12 error_text options.2_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="options">Pilhan 4</label>
                                    <input type="text" id="options" class="form-control" name="options[]"
                                        placeholder="Pilhan 4" />
                                </div>
                                <span class="text-danger col-12 error_text options.3_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="options">Pilhan 5</label>
                                    <input type="text" id="options" class="form-control" name="options[]"
                                        placeholder="Pilhan 5" />
                                </div>
                                <span class="text-danger col-12 error_text options.4_error"></span>
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
                </form>
            </div>
        </div>
    </div>
</div>