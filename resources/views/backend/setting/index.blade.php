@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h1 class="h5 mb-0 text-gray-800">Pengaturan Web</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pass">Logo</label>
                                        <img src="{{ asset('storage/user/' . auth()->user()->image) }}" class="img-preview rounded img-fluid mb-3 d-block" id="imgP">
                                        <input class="form-control" type="file" id="image" name="image" onchange="previewImg()">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    @if (session()->has('msg'))
                                    <div class="alert alert-success">{!! session('msg') !!}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nama">Nama website</label>
                                        <input type="text" class="form-control @error('name') ? is-invalid @enderror" id="nama" value="{{ auth()->user()->name }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Tentang KOBI</label>
                                        <textarea type="text" class="form-control" id="nama"  name="name" rows="7"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h1 class="h5 mb-0 text-gray-800">Kontak dan Sosial Media</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="#">No Tlp</label>
                                        <input type="number" class="form-control" name="no_tlp">
                                    </div>
                                </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    function previewImg(){
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('#imgP');
      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob; 
    }
</script>
@endpush