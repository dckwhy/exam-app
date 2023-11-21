<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="title"></h4>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.try-out.store') }}" id="main_form"
                    method="POST" autocomplete="off">
                    <div class="form-body px-3">
                        <div class="row">
                            <input type="hidden" name="id" id="id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Mata Pelajaran</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Mata Pelajaran" />
                                </div>
                                <span class="text-danger error_text name_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tier">Tingkat</label>
                                    <select name="tier" id="tier" class="form-control">
                                        <option disabled selected>-- Pilih Tingkat --</option>
                                        @foreach ($tiers as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger error_text tier_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="day">Hari</label>
                                    <select name="day[]" id="day" class="form-select" multiple>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <span class="text-danger error_text day_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="time_start">Jam Mulai</label>
                                    <input type="time" id="time_start" class="form-control" name="time_start"
                                        placeholder="Jam Mulai" />
                                </div>
                                <span class="text-danger error_text time_start_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="time_end">Jam Selesai</label>
                                    <input type="time" id="time_end" class="form-control" name="time_end"
                                        placeholder="Jam Selesai" />
                                </div>
                                <span class="text-danger error_text time_end_error"></span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="duration">Durasi <span class="text-danger"><small>(Dalam
                                                Menit)</small></span></label>
                                    <input type="number" id="duration" class="form-control" name="duration"
                                        placeholder="Durasi" />
                                </div>
                                <span class="text-danger error_text duration_error"></span>
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