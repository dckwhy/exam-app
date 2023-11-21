@extends('layouts.main', ['title' => 'Profile '. $user->name])
@push('css')
<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
</style>
@endpush
@section('content')
<div class="card p-3">
    <div class="card-header bg-primary text-center">
        <h3 class="text-white">Profile</h3>
    </div>
    <div class="card-body">
        <div class="row my-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" alt="Admin" class="rounded-circle"
                                width="250" height="250">
                            @else
                            <img src="{{ asset('img/default-user.png') }}" alt="Admin" class="rounded-circle"
                                width="250" height="250">
                            @endif
                            <div class="mt-3 mb-5">
                                <h3>{{ $user->name }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                : {{ $user->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-warning" id="updateProfile"
                                    value="{{ $user->id }}"><i class="fa fa-pencil"></i> Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@includeIf('pages.admin.profile.modal')
@endsection
@push('js')
<script>
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

    function resetError() {
        $('#modal').find('input').val("");
        $('#img_preview').hide();
    }

    $('#updateProfile').click(function() {
        var id = $(this).val();
        resetError()
        var url = '{!! asset('storage') !!}'
        var urlPublic = '{!! asset('img/default-user.png') !!}'
        // ajax
        $.ajax({
            type: "GET",
            url: "/admin/profile/" + id + '/edit',
            success: function(response) {
                $('#img_preview').show();
                $('#title').html("Ubah Profile");
                $('#modal').modal('show');
                $('#id').val(response.id);
                $('#name').val(response.name);
                $('#email').val(response.email);
                $('#photo_old').val(response.photo);
                if(response.photo){
                    $('#img_preview').attr("src", url + '/' + response.photo);
                }else{
                    $('#img_preview').attr("src", urlPublic);
                }
            }
        });
    });

    $('#main_form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error_text').text('')
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    $('#main_form').trigger("reset");;
                    $('#modal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function(){ location.reload(); }, 3000);
                }
            }
        })
    })

    $('#img_preview').hide()

    function previewImage() {
        $('#img_preview').show()
        const image = document.querySelector('#photo');
        const imgPreview = document.querySelector('#img_preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFEvent) {
            imgPreview.src = oFEvent.target.result;
        }
    }
</script>
@endpush