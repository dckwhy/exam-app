@extends('layouts.main', ['title' => 'Daftar Kelas Terdaftar'])
@push('css')
<style>
    .icon {
        width: 3rem;
        height: 3rem;
    }

    .icon i {
        font-size: 2.25rem;
    }

    .icon-shape {
        display: inline-flex;
        padding: 12px;
        text-align: center;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kelas Terdaftar</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kelas Terdaftar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            @forelse ($user_exams as $e)
            @php
            $tier = explode(' ',$e->tier->name);
            @endphp
            @if ( $tier[0] == 'SMP')
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card" style="background-color: #219ebc">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon mb-2">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h4 class="font-semibold text-white">{{ $e->tier->name }}</h4>
                                {{-- <h6 class="font-extrabold text-white mb-0">Rp. {{ number_format($e->tier->price, 0)
                                    }} --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row">
                        @if ($e->status != 3)
                        <h6 class="text-center text-white">Menunggu Validasi</h6>
                        @else
                        <a href="{{ route('siswa.kelas.try-out.index', $e->tier_id) }}"
                            class="btn btn-dark btn-sm">Detail <i class="fas fa-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card" style="background-color: #023047">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon mb-2">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h4 class="font-semibold text-white">{{ $e->tier->name }}</h4>
                                {{-- <h6 class="font-extrabold text-white mb-0">Rp. {{ number_format($e->tier->price, 0)
                                    }}
                                </h6> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row d-flex justify-content-center">
                        @if ($e->status != 3)
                        <h6 class="text-center text-white">Menunggu Validasi</h6>
                        @else
                        <a href="{{ route('siswa.kelas.try-out.index', $e->tier_id) }}"
                            class="btn btn-info btn-sm">Detail <i class="fas fa-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="col-12 text-center">
                <h3>Belum Ada Kelas Yang Terdaftar</h3>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection