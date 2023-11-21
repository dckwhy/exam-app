@extends('layouts.main', ['title' => 'Dashboard'])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        @if ($check)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            Kamu masih menggunakan password default. Mohon segera merubah password anda di menu Profile atau anda bisa
            <a href="{{ route('siswa.profile.index') }}" class="btn btn-warning btn-sm">Klik Disini</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row mt-4">
            <div class="col-12">
                <h4 class="text-center">Tentang</h4>
                <p align=justify>
                    Ashyilla Course didirikan pada tahun 2012 oleh ibu Yustikanida, dengan motivasi untuk
                    membantu meningkatkan kualitas pendidikan terkhusus di daerah kabupaten melawi.
                    Memulai dari bimbingan belajar untuk sekolah dasar, kini Ashyilla Course sudah
                    menyediakan program bimbingan belajar mulai dari PAUD sampai ke sekolah menengah atas
                    (SMA). Dengan dibantu dengan tutor yang terpilih dan berkualitas.
                    Hingga kini Ashyilla Course telah membimbing ribuan siswa dengan kurang lebih 300 siswa
                    aktif yang masih mengikuti program kami. Kedepannya kami akan selalu meningkatkan
                    kualitas, baik pelayanan customer,guru hingga program bimbingan belajar kami. Sehingga
                    kedepannya kualitas Ashyilla Course akan menjadi lebih baik, untuk menopang aktivitas
                    kami.
                </p>
            </div>
            <div class="col-12 text-center">
                <h4 class="text-center">Visi</h4>
                <p>
                    Menjadi lembaga bimbingan belajar profesional yang dapat dijangkau oleh segala kalangan.
                </p>
            </div>
            <div class="col-12 text-center">
                <h4 class="text-center">Misi</h4>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item border-0">
                        Membantu Meningkatkan budaya belajar untuk pendidikan nasional.
                    </li>
                    <li class="list-group-item border-0">
                        Memberikan kualitas terbaik untuk program yang diberikan.
                    </li>
                    <li class="list-group-item border-0">
                        Memberikan layanan bimbingan belajar dengan harga terjangkau untuk memfasilitasi
                        semua kalangan.
                    </li>
                    <li class="list-group-item border-0">
                        Menjadi tempat siswa/i berkembang dalam proses pembelajaran mereka.
                    </li>
                </ol>
            </div>
        </div>
    </section>
</div>
@endsection