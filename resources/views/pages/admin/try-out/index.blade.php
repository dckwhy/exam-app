@extends('layouts.main', ['title' => 'Data Try Out'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Try Out</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Try Out</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" id="add"><i class="fa fa-plus-circle"></i> Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Mata Pelajaran</th>
                            <th>Tingkat</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Durasi <span class="text-danger"><small>(Dalam Menit)</small></span></th>
                            <th>Status</th>
                            <th><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
@includeIf('pages.admin.try-out.modal')
@endsection
@push('js')
<script>
    $(document).ready(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if(session('success'))
            Toast.fire({
            icon: 'success',
            title: '{!! session('success') !!}'
            });
        @endif

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#day').select2({
            dropdownParent: $("#modal"),
            theme: "bootstrap-5",
            placeholder: "Pilih Hari",
        });

        const table = $('#table').DataTable({
            processing: true,
            autoWidth: false,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('admin.try-out.index') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'tier'
                },
                {
                    data: 'day'
                },
                {
                    data: 'time_start'
                },
                {
                    data: 'time_end'
                },
                {
                    data: 'duration'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ],
            columnDefs: [{
                className: 'text-center',
                targets: '_all'
            }]
        });

        $('#add').click(function() {
            $('#main_form').trigger("reset");;  
            $('#id').val('');
            $('span.error_text').html("");
            $('#title').html("Tambah Data Try Out");
            $('#modal').modal('show');
        });

        $('body').on('click', '#edit', function() {
            let id = $(this).val();
            $('span.error_text').html("");
            $.ajax({
                type: "GET",
                url: "/admin/try-out/" + id + '/edit',
                success: function(response) {
                    let days = JSON.parse(response.day);
                    $('#title').html("Ubah Data Try Out");
                    $('#modal').modal('show');
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#tier').val(response.tier_id);
                    $('#day').val(days).trigger('change');
                    $('#time_start').val(response.time_start);
                    $('#time_end').val(response.time_end);
                    $('#duration').val(response.duration);
                }
            });
        });

        $('body').on('click', '#delete', function() {
            let id = $(this).val();

            Swal.fire({
                title: 'Apakah anda yakin akan menghapus data ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#FF0000',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#3085d6',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/try-out/" + id,
                        success: function(response) {
                            if (response.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success
                                });
                                table.ajax.reload();
                            }
                            if (response.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal...',
                                    text: response.error,
                                })
                            }
                        }
                    });
                }
            })
        });

        $('#main_form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error_text').text('')
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $('#main_form').trigger("reset");;
                        table.ajax.reload();
                        $('#modal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        });
                    }
                }
            })
        })
    });
</script>
@endpush