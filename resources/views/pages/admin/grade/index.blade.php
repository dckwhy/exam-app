@extends('layouts.main', ['title' => 'Data Nilai Try Out ' . $try_out->name])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Nilai Try Out {{ $try_out->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Nilai Try Out {{ $try_out->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.tingkat.try-out', $try_out->tier_id) }}" class="btn btn-danger"><i
                        class="fa fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Nama Siswa</th>
                            <th>Percobaan Ke</th>
                            <th>Jumlah Soal</th>
                            <th>Jawaban Benar</th>
                            <th>Jawaban Salah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @for($i = 0; $i < count($result_array); $i++) @php $try=1; @endphp @foreach ($results->
                            where('user_id',
                            $result_array[$i]['user_id']) as $r)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $r->user->name }}</td>
                                <td>{{ $try++ }}</td>
                                <td>{{ $r->number_of_question }}</td>
                                <td>{{ $r->correct_amount }}</td>
                                <td>{{ $r->wrong_amount }}</td>
                                <td>{{ number_format($r->grade,1) }}</td>
                            </tr>
                            @endforeach
                            @endfor
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