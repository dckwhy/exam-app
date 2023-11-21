@extends('layouts.main', ['title' => 'Data History Harga Tingkat'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data History Harga Tingkat</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data History Harga Tingkat</li>
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
                            <th>Nama Tingkat</th>
                            <th>Harga Lama</th>
                            <th>Harga Baru</th>
                            <th>Alasan</th>
                            <th>Diubah</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
@includeIf('pages.admin.tier.modal')
@endsection
@push('js')
<script>
    $(document).ready(function () {
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
                url: '{{ route('admin.tingkat.history') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tier'
                },
                {
                    data: 'old_price'
                },
                {
                    data: 'new_price'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'updated_at'
                }
            ],
            columnDefs: [{
                className: 'text-center',
                targets: '_all'
            }]
        });
    });
</script>
@endpush