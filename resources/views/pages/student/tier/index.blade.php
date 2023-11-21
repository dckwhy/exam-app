@extends('layouts.main', ['title' => 'Daftar Kelas'])
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
                <h3>Daftar Kelas</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kelas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            @forelse ($classes as $c)
            @php
            $tier = explode(' ',$c->name);
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
                                <h4 class="font-semibold text-white">{{ $c->name }}</h4>
                                <h6 class="font-extrabold text-white mb-0">Rp. {{ number_format($c->price, 0) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row">
                        <button type="button" class="btn btn-dark col-12" id="register"
                            value="{{ $c->id }}">Daftar</button>
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
                                <h4 class="text-white font-semibold">{{ $c->name }}</h4>
                                <h6 class="font-extrabold text-white mb-0">Rp. {{ number_format($c->price, 0) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row">
                        <button type="button" class="btn btn-info col-12" id="register"
                            value="{{ $c->id }}">Daftar</button>
                    </div>
                </div>
            </div>
            @endif
            @empty
            @endforelse
        </div>
    </section>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
        });

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#register', function() {
            let id = $(this).val();
            Swal.fire({
                title: 'Apakah kamu yakin akan mendaftar ke kelas ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#FF0000',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#3085d6',
            }).then(function(result) {
                if(result.value){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('siswa.kelas.store') }}",
                        data: {
                            "id":id
                        },
                        dataType:"json",
                        success: function(response) {
                            if (response.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success
                                });
                                setTimeout(function(){ location.reload(); }, 3000);
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: response.error
                                });
                            }
                        }
                    });
                }
            })
        })
    })
</script>
@endpush