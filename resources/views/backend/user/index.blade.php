@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h1 class="h5 mb-0 text-gray-800">Profil Pengguna</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/admin/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="pass">Foto profil</label>
                                        <img src="{{ asset('storage/user/' . auth()->user()->image) }}" class="img-preview rounded img-fluid mb-3 d-block" id="imgP">
                                        <input class="form-control" type="file" id="image" name="image" onchange="previewImg()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (session()->has('msg'))
                                    <div class="alert alert-success">{!! session('msg') !!}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('name') ? is-invalid @enderror" id="nama" value="{{ auth()->user()->name }}" name="name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') ? is-invalid @enderror" value="{{ auth()->user()->email }}" name="email">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profil</button>
                                </div>
                            </form>
                            <form action="/admin/password/{{ auth()->user()->id }}" method="POST">
                                @csrf
                                <div class="col-md-12 ml-5">
                                    @if (session()->has('warning'))
                                    <div class="alert alert-danger">{!! session('warning') !!}</div>
                                    @endif
                                    @if (session()->has('success'))
                                    <div class="alert alert-success">{!! session('success') !!}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="oldPassword">Password saat ini</label>
                                        <input type="password" class="form-control @error('oldPassword') ? is-invalid @enderror"  name="currentPassword" autocomplete="off">
                                        @error('oldPassword')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password baru</label>
                                        <input type="password" class="form-control @error('password') ? is-invalid @enderror"  name="password" autocomplete="off">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
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