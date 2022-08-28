@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5" id="x-title">Tambah foto baru</h3>
        </div>
        <div class="card-body">
            <form id="formSubmit">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control" placeholder="Judul foto">
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-update btn btn-primary" id="x-button">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Semua foto</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($galleries as $gallery)
                <div class="col-sm-4 mb-4">
                    <div class="card">
                      <div class="card-body">
                      <img data-src="{{ asset('storage/galeri/' . $gallery->photo) }}" alt="" width="100%" class="lazyload">
                        <button href="#" class="btn btn-sm btn-warning mt-3 btnEdit" data-title="{{ $gallery->title }}" data-id="{{ $gallery->id }}" data-toggle="modal" data-target="#exampleModal">Edit</button>
                        <button class="btn btn-sm btn-danger mt-3" onclick="btnDelete({{ $gallery->id }})">Hapus</button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="row justify-content-center">
                    {{ $galleries->links('vendor.pagination.backend', ['elements' => $galleries]) }}
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
                    <input type="text" name="title" class="form-control title-photo">
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
    <script>
        $('#formSubmit').submit(function(event) {
            event.preventDefault();
            console.log('okeee');
            
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/gallery/photo',
                data: data,
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                if(response.status == 201) {
                swal({
                    title: "",
                    text: "Photo berhasil ditambahkan",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/galeri/foto');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
                }
            });
        });

        //edit foto
        $('button.btnEdit').on('click', function() {
            let title = $(this).data('title');
            let id = $(this).data('id');
            $('input.title-photo').val(title);
            $('input[name=id]').val(id);
        });

        $('#formUpdate').submit(function(event){
            event.preventDefault();
            $('#exampleModal').modal('hide');

            let id = $('input[name=id]').val();
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/gallery/photo/'+id,
                data: data,
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 201) {
                swal({
                    title: "",
                    text: "Photo berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/galeri/foto');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
                } 
            });
        });

        //delete foto
        function btnDelete(id){
        swal({
        title: "",
        text: "Hapus foto ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/gallery/photo/'+id,
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
                        window.location.replace(BaseUrl+'/admin/galeri/foto');
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