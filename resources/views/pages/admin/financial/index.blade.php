@extends('layouts.main', ['title' => 'Data Laporan Keuangan'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Laporan Keuangan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Laporan Keuangan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="student">By Student</label>
                                <select name="student" id="student" class="form-control">
                                    <option disabled selected>-- Pilih Siswa --</option>
                                    @foreach ($students as $s)
                                    <option value="{{ $s->user->id }}">{{ $s->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="tier">By Tier</label>
                                <select name="tier" id="tier" class="form-control">
                                    <option disabled selected>-- Pilih Tingkat --</option>
                                    @foreach ($tiers as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="period">By Period</label>
                                <select name="period" id="period" class="form-control">
                                    <option disabled selected>-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> -->
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Siswa</th>
                            <th>Nama Tingkat</th>
                            <th>Harga</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
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

        const table = $('#table').DataTable({
            processing: true,
            autoWidth: false,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('admin.report.index') }}',
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
                    data: 'period'
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