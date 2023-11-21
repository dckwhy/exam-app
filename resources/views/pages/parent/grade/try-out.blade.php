@extends('layouts.main', ['title' => 'Data Try Out ' . $tier->name])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Try Out {{ $tier->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Try Out {{ $tier->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('orang-tua.kelas.grade', $id) }}" class="btn btn-danger"><i
                        class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Mata Pelajaran</th>
                            <th><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($try_outs as $t)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $t->name }}</td>
                            <td>
                                <a href="{{ route('orang-tua.kelas.grade.try-out.detail', [$id, $t->tier_id, $t->id]) }}"
                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('orang-tua.kelas.grade.try-out.export', [$id, $t->tier_id, $t->id]) }}"
                                    class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
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