@extends('layouts.main', ['title' => 'Data Kelas Anak : ' . $user->name])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kelas Anak : {{ $user->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Kelas Anak : {{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('orang-tua.grade') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Tingkat</th>
                            <th><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($user_exams as $u)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $u->tier->name }}</td>
                            <td>
                                <a href="{{ route('orang-tua.kelas.grade.try-out', [$u->child_id, $u->tier_id]) }}"
                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        const table = $('#table').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
        });
    })
</script>
@endpush