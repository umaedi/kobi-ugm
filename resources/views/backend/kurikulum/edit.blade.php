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
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
              <h3 class="h5 mb-0 text-gray-800 d-inline">Edit Kurikulum</h3>
        </div>
        <form id="formPost">
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $kurikulum->title }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="title">Thumbnail</label>
                        <input type="file" class="form-control" name="image">
                      </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="date" class="form-control" name="publish_at">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Dibuat pada
                        </small>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <select class="form-control @error('status') ? is-invalid @enderror" id="exampleFormControlSelect1" name="status">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                        </select>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Status
                        </small>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="form-group">
                <label for="body">Konten</label>
                <textarea class="form-control" name="body" rows="5" id="task-textarea">{{ $kurikulum->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-globe"></i> Perbaharui</button>
        </div>
    </form>
    </div>
</div>
@endsection
@push('js')
@include('components.backend.ckeditor')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
<script>
        $('#formPost').submit(function(event) {
        event.preventDefault();
        let from = $(this)[0];
        let data = new FormData(from);

        $.ajax({
        url: BaseUrl+'/api/admin/kurikulum/{{ $kurikulum->id }}',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Kurikulum berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/kurikulum');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
    });
    });
</script>
@endpush