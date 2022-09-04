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
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Visi Misi dan Tujuan</h3>
                        <a href="{{ url('/admin/dashboard') }}" class="d-inline ml-auto btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formAboutUpdate">
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $visi->title }}">
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
                            <label for="body">Visi Misi dan Tujuan</label>
                            <textarea class="form-control" name="body" rows="5" id="task-textarea">{{ $visi->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn btn-primary"></i> Perbaharui</button>
                    </div>
                </form>
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
        url: BaseUrl+'/api/admin/visi-misi/{{ $visi->id }}',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Visi misi dan tujuan berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/visi-misi');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
    });
    });
</script>
@endpush