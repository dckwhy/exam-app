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
                <a href="{{ route('siswa.kelas.index-registered') }}" class="btn btn-danger"><i
                        class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Mata Pelajaran</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Durasi <span class="text-danger"><small>(Dalam Menit)</small></span></th>
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
                                @php
                                $days = json_decode($t->day);
                                @endphp
                                @foreach ($days as $d)
                                @if (!$loop->last)
                                {{ $d}},
                                @else
                                {{ $d}}
                                @endif
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$t->time_start)->format('h:i') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$t->time_end)->format('h:i') }}</td>
                            <td>{{ $t->duration }}</td>
                            <td>
                                <a href="{{ route('siswa.kelas.try-out.create', $t->id) }}"
                                    class="btn btn-primary btn-sm">Kerjakan <i class="fas fa-arrow-right"></i></a>
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
        
        const table = $('#table').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
        });
    })
</script>
@endpush