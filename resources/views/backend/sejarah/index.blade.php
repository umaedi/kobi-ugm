@extends('layouts.backend.app')
@push('css')
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Sejarah</h3>
                        <a href="{{ url('/admin/dashboard') }}" class="d-inline ml-auto btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formAboutUpdate">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $about->title }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="title">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">Sejarah</label>
                            <textarea class="form-control" name="body" rows="5" id="task-textarea">{{ $about->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn btn-primary"></i> Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Pendiri</h3>
                        <a href="{{ url('/admin/dashboard') }}" class="d-inline ml-auto btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formFounder">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="title">Jabatan</label>
                                    <input type="text" class="form-control" id="title" name="position">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="photo">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                </form>
                <div class="card-body">
                    <hr>
                    <div class="row justify-content-center">
                        @foreach ($founders as $fo)
                        <div class="card mr-3" style="width: 18rem;">
                            <img class="card-img-top lazyload" data-src="{{ asset('storage/xfound/'. $fo->photo) }}">
                            <ul class="list-group list-group-flush text-center">
                              <li class="list-group-item font-weight-bold">{{ $fo->name }}</li>
                              <li class="list-group-item">{{ $fo->position }}</li>
                            </ul>
                            <div class="card-body text-center">
                              <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $fo->id }}" data-name="{{ $fo->name }}" data-position="{{ $fo->position }}"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                              <button class="btn btn-sm btn-danger" onclick="deteletFo({{ $fo->id }})">Hapus</button>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Simpan perubahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdate">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <input type="text" name="name" class="form-control founder-name">
                </div>
                <div class="form-group">
                    <input type="text" name="position" class="form-control founder-position">
                </div>
                <div class="form-group">
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
@include('components.backend.ckeditor')

<script>
    $('#formAboutUpdate').submit(function(event) {
        event.preventDefault();
        let from = $(this)[0];
        let data = new FormData(from);

        $.ajax({
        url: BaseUrl+'/api/admin/sejarah/{{ $about->id }}',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Sejarah berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/sejarah');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
    });
    });

    //founder
    $('#formFounder').submit(function(event){
        event.preventDefault();

        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/founder',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Foto berhasil diunggah",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/sejarah');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
        });
    });

    //update
    $('button.btnEdit').click(function() {
        let id = $(this).data('id')
        let name = $(this).data('name');
        let position = $(this).data('position');

        $('input[name=id]').val(id);
        $('input.founder-name').val(name);
        $('input.founder-position').val(position);
    });

    $('#formUpdate').submit(function() {
        event.preventDefault();
        $('#exampleModal').modal('hide');

        let id = $('input[name=id]').val();
        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/founder/'+id,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
                if(response.status == 201) {
                swal({
                    title: "",
                    text: "Pendiri berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/sejarah');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
            } 
        });
    });
    

    //delete
    function deteletFo(id){
        swal({
        title: "",
        text: "Hapus photo pendiri ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/founder/'+id,
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                    swal({
                    title: "",
                    text: "Photo berhasil dihapus",
                    icon: "success"
                    })
                    .then((value) => {
                        window.location.replace(BaseUrl+'/admin/sejarah');
                    });
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
                });
            }
        });  
    }
</script>
@endpush