@extends('layouts.main', ['title' => 'Kelas Terdaftar Anak'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelas Terdaftar Anak</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas Terdaftar Anak</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Anak</th>
                            <th>Kelas</th>
                            <th>Harga Kelas</th>
                            <th>Status</th>
                            <th><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
@includeIf('pages.parent.tier.modal')
@includeIf('pages.parent.tier.modal-payment')
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
            processing: true,
            autoWidth: false,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('orang-tua.anak.registered') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'child'
                },
                {
                    data: 'tier'
                },
                {
                    data: 'tier_price'
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

        $('body').on('click', '#detail', function() {
            let id = $(this).val();
            var url = '{!! asset('storage') !!}';
            $.ajax({
                type: "GET",
                url: "/orang-tua/anak/kelas/" + id + '/detail',
                success: function(response) {
                    $('#modal-detail').modal('show');
                    $('#title-detail').html("Bukti Pembayaran");
                    $('#payment').attr("src", url + '/' + response.proof_of_payment);
                }
            });
        });

        $('body').on('click', '#addPayment', function() {
            let id = $(this).val();
            $('#id').val(id);
            $('span.error_text').html("");
            $('#title').html("Upload Bukti Pembayaran");
            $('#modal').modal('show');
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