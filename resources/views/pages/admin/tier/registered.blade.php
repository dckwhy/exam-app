@extends('layouts.main', ['title' => 'Data Pendaftar Kelas'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pendaftar Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pendaftar Kelas</li>
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
                url: '{{ route('admin.pendaftar.registered') }}',
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
                url: "/admin/pendaftar/" + id + '/detail',
                success: function(response) {
                    $('#modal-detail').modal('show');
                    $('#title-detail').html("Bukti Pembayaran");
                    $('#payment').attr("src", url + '/' + response.proof_of_payment);
                }
            });
        });

        $('body').on('click', '#agreed', function() {       
            let id = $(this).val();
            Swal.fire({
                title: 'Apakah kamu yakin akan memvalidasi pembayaran siswa ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#FF0000',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#3085d6',
            }).then(function(result) {
                if(result.value){
                    $.ajax({
                        type: "GET",
                        url: "/admin/pendaftar/" + id + "/validasi",
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            if (response.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success
                                });
                                setTimeout(function(){ location.reload(); }, 3000);
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
        })
    });

</script>
@endpush