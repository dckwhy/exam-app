@extends('layouts.main', ['title' => 'Daftar Pertanyaan - ' . $try_out->name])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pertanyaan - {{ $try_out->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Pertanyaan - {{ $try_out->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary {{ $try_out->status == 1 ? 'disabled' : '' }}" id="add"
                    value="{{ $try_out->id }}"><i class="fa fa-plus-circle"></i>
                    Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Pilihan</th>
                            <th>Status</th>
                            <th><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($questions as $q)
                        @php
                        $options = json_decode($q->options);
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $q->question }}</td>
                            <td>{{ $q->answer }}</td>
                            <td>
                                @foreach ($options as $o)
                                @if (!$loop->last)
                                {{ $o}},
                                @else
                                {{ $o}}
                                @endif
                                @endforeach
                            </td>
                            <td>
                                <button type="button" id="activate"
                                    class="btn btn-success btn-sm {{ $q->status == 1 ? 'disabled' : '' }}"
                                    value="{{ $q->id }}"><i class="fa fa-check"></i></button>
                                <button type="button" id="deactivate"
                                    class="btn btn-danger btn-sm {{ $q->status == 0 ? 'disabled' : '' }}"
                                    value="{{ $q->id }}"><i class="fa fa-times"></i></button>
                            </td>
                            <td>
                                {{-- <button type="button" id="edit"
                                    class="btn btn-warning btn-sm {{ $try_out->status == 1 ? 'disabled' : '' }}"
                                    value="{{ $q->id }}"><i class="fa fa-edit"></i></button> --}}
                                <button type="button" id="delete"
                                    class="btn btn-danger btn-sm {{ $try_out->status == 1 ? 'disabled' : '' }}"
                                    value="{{ $q->id }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@includeIf('pages.admin.question.modal')
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

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        const table = $('#table').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
        });

        $('#add').click(function() {
            let id = $(this).val();
            $('#main_form').trigger("reset");;  
            $('#id').val('');
            $('#try_out_id').val(id);
            $('span.error_text').html("");
            $('#title').html("Tambah Pertanyaan");
            $('#modal').modal('show');
        });

        $('body').on('click', '#edit', function() {
            let id = $(this).val();
            $('span.error_text').html("");
            $.ajax({
                type: "GET",
                url: "/admin/pertanyaan/" + id + '/edit',
                success: function(response) {
                    $('#title').html("Ubah Data Pertanyaan");
                    $('#modal').modal('show');
                    $('#id').val(response.id);
                    $('#try_out_id').val(response.try_out_id);
                    $('#question').val(response.question);
                    $('#answer').val(response.answer);
                    let options = JSON.parse(response.options);

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
                        url: "/admin/pertanyaan/" + id,
                        success: function(response) {
                            if (response.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success
                                });
                            }
                            if (response.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal...',
                                    text: response.error,
                                })
                            }
                            setTimeout(function(){ location.reload(); }, 3000);
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
                            if(prefix != 'question' || prefix != 'answer'){
                                let pre = prefix.split('.');
                                $('span.'+pre[0]+'\\.'+pre[1]+'_error').empty().text(val[0]);
                            }
                            $('span.'+prefix+'_error').empty().text(val[0]);
                        });
                    }else{
                        $('#main_form').trigger("reset");;
                        $('#modal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        });
                        setTimeout(function(){ location.reload(); }, 3000);
                    }
                }
            })
        })

        $('body').on('click', '#activate', function() {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/admin/pertanyaan/"+id+"/aktifkan",
                success: function(response) {
                    if(response.status == 1){
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                        setTimeout(function(){ location.reload(); }, 3000);
                    }
                }
            });
        });

        $('body').on('click', '#deactivate', function() {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/admin/pertanyaan/"+id+"/nonaktifkan",
                success: function(response) {
                    if(response.status == 1){
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                        setTimeout(function(){ location.reload(); }, 3000);
                    }
                }
            });
        });
    });
</script>
@endpush