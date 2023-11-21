@extends('layouts.main', ['title' => 'Try Out ' . $try_out->name])
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Try Out {{ $try_out->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Try Out {{ $try_out->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row d-flex justify-content-center my-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h5><b>Timer</b> : <span class="js-timeout" id="timer">{{
                                        $try_out->duration}}:00</span></h5>
                            </div>
                            <div class="col-6 text-end">
                                <h5 class="text-right"><b>Status</b> :Running</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('siswa.kelas.try-out.store') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="form-body px-3">
                                <input type="hidden" name="try_out_id" value="{{ $try_out->id }}">
                                <div class="row d-flex justify-content-center">
                                    @foreach ($questions as $key => $q)
                                    <div class="col-lg-10 col-md-12 col-12 my-3">
                                        <p>{{$key+1}}. {{ $q->question}}</p>
                                        <?php 
                                            $options = json_decode($q->options,true);
                                        ?>
                                        <input type="hidden" name="question{{$key+1}}" value="{{$q->id}}">
                                        <ul class="list-group">
                                            <li class="list-group-item"><input type="radio" value="{{ $options[0]}}"
                                                    name="answer{{$key+1}}"> {{
                                                $options[0]}}</li>
                                            <li class="list-group-item"><input type="radio" value="{{ $options[1]}}"
                                                    name="answer{{$key+1}}"> {{
                                                $options[1]}}</li>
                                            <li class="list-group-item"><input type="radio" value="{{ $options[2]}}"
                                                    name="answer{{$key+1}}"> {{
                                                $options[2]}}</li>
                                            <li class="list-group-item"><input type="radio" value="{{ $options[3]}}"
                                                    name="answer{{$key+1}}"> {{
                                                $options[3]}}</li>
                                            <li class="list-group-item"><input type="radio" value="{{ $options[4]}}"
                                                    name="answer{{$key+1}}"> {{
                                                $options[4]}}</li>

                                            <li style="display: none;"><input value="0" type="radio" checked="checked"
                                                    name="answer{{$key+1}}"> {{ $options[4]}}</li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="index" value="{{ $key+1}}">
                                    <button type="submit" class="btn btn-primary" id="myCheck"><i
                                            class="fa fa-save"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('js')
<script>
    var interval;
    function countdown() {
        clearInterval(interval);
        interval = setInterval( function() {
            var timer = $('.js-timeout').html();
            timer = timer.split(':');
            var minutes = timer[0];
            var seconds = timer[1];
            seconds -= 1;
            if (minutes < 0) return;
            else if (seconds < 0 && minutes != 0) {
                minutes -= 1;
                seconds = 59;
            }
            else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

            $('.js-timeout').html(minutes + ':' + seconds);

            if (minutes == 0 && seconds == 0) { 
                clearInterval(interval); 
                Swal.fire({
                    icon: 'warning',
                    title: 'Waktu Habis',
                })
                myFunction() 
            }
        }, 1000);
    }

    var time = document.getElementById('timer').value;
    $('.js-timeout').text(time);
    countdown();

    function myFunction() {
        setInterval( function() {
        document.getElementById("myCheck").click();
        },3000)
    }

    $(document).on("keydown", function (e) {
        if (e.key == "F5" || e.key == "F11" || 
            (e.ctrlKey == true && (e.key == 'r' || e.key == 'R')) || 
            e.keyCode == 116 || e.keyCode == 82) {
                e.preventDefault();
        }
    });

</script>
@endpush