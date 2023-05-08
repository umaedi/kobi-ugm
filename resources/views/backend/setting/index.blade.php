@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid">
        <form id="form_submit">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Logo</h6>
                    </div>
                    <div class="card-body">
                        <img id="logoPreview" src="{{ \Illuminate\Support\Facades\Storage::url($settings->logo) }}" alt="" width="100%">
                        <input type="file" name="logo" class="form-control mt-3" id="logo" onchange="previewLogo()">
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tentang Website</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama-website">Nama Website</label>
                            <input type="text" class="form-control" name="nama_web" id="nama-website" value="{{ $settings->nama_web }}">
                        </div>
                        <div class="form-group">
                            <label for="nama-website">Tentang Website</label>
                            <textarea name="tentang_web" id="" class="form-control" cols="10" rows="5">{{ $settings->tentang_web }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="nama-website">Alamat</label>
                            <textarea name="tentang_web" id="" class="form-control" cols="10" rows="3">{{ $settings->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Footer</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama-website">Text Footer</label>
                            <textarea name="text_footer" id="" class="form-control" cols="10" rows="5">{{ $settings->text_footer }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Photo Ketua</h6>
                    </div>
                    <div class="card-body">
                        <img id="photoPreview" src="{{ \Illuminate\Support\Facades\Storage::url($settings->photo_ketua) }}" alt="" width="100%">
                        <input id="photo" type="file" name="photo_ketua" class="form-control mt-3" onchange="previewPhoto()">
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="no_tlp">No Telepon</label>
                            <input type="text" class="form-control" name="no_tlp" value="{{ $settings->no_tlp }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $settings->email }}">
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sosial Media</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="ig">Instagram</label>
                            <input type="text" class="form-control" name="instagram" value="{{ $settings->instagram }}">
                        </div>
                        <div class="form-group">
                            <label for="tw">Tweeter</label>
                            <input type="text" class="form-control" name="tweeter" value="{{ $settings->tweeter }}">
                        </div>
                        <div class="form-group">
                            <label for="fb">Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{ $settings->facebook }}">
                        </div>
                    </div>
                </div>
                @include('components._loading_submit')
                <button id="btn_submit" type="submit" class="btn btn-primary btn-block">SIMPAN</button>
            </div>
        </div>
    </form>
    </div>
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#form_submit').submit(async function store(e) {
            e.preventDefault();

            var form 	= $(this)[0]; 
            var data 	= new FormData(form);

            var param = {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                url: '/api/admin/websetting',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
            }

                loadingsubmit(true);
                await transAjax(param).then((res) => {
                    swal({text: res.message, icon: 'success'});
                    loadingsubmit(false);
                }).catch((err) => {
                    loadingsubmit(false);
                    swal({text: err.responseJSON.message, icon: 'error', timer: 3000,}).then(() => {
                    window.location.href = '/admin/web/settings';
                });
            });

            function loadingsubmit(state){
                if(state) {
                    $('#btn_loading').removeClass('d-none');
                    $('#btn_submit').addClass('d-none');
                }else {
                    $('#btn_loading').addClass('d-none');
                    $('#btn_submit').removeClass('d-none');
                }
            }
        });
    });

    function previewLogo(){
      const image = document.querySelector('#logo');
      const imgPreview = document.querySelector('#logoPreview');
      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob; 
    }

    function previewPhoto(){
      const image = document.querySelector('#photo');
      const imgPreview = document.querySelector('#photoPreview');
      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob; 
    }
</script>
@endpush