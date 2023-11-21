@extends('layouts.main', ['title' => 'Daftar Pengajar'])
@push('css')
<style>
    .mt-n1 {
        margin-top: -0.5rem !important;
    }
</style>
@endpush
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pengajar</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Pengajar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section my-3">
        <div class="row">
            @forelse ($teachers as $t)
            <div class="col-lg-2 col-md-3 col-4" style="background-color:whitesmoke;">
                <div class="card" style="min-height:260px !important">
                    <div class="card-body">
                        <div class="row d-flex-justify-content-center">
                            <div class="col-12">
                                <img src="{{ asset('img/default-user.png') }}" class="rounded mx-auto d-block"
                                    width="100" alt="Foto Pengajar">
                            </div>
                            <span class="text-center mt-3">{{ $t->name }}</span>
                            <span class="text-center">{{ $t->subject }}</span>
                            <span class="text-center">{{ $t->graduate }}</span>
                            {{-- @php
                            $experience = json_decode($t->experience);
                            @endphp
                            <hr>
                            <span class="text-center mt-n1">
                                @foreach ($experience as $e)
                                @if (!$loop->last)
                                {{ $e }},
                                @else
                                {{ $e }}
                                @endif
                                @endforeach
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 d-flex justify-content-center">
                <h3 class="text-center">Belum Ada Data Guru</h3>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection