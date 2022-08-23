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
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Buat Post Baru</h3>
                        <a href="/admin/post" class="d-inline ml-auto btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formPostUpdate">
                    @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="title">Thumbnail</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select class="form-control @error('category_id') ? is-invalid @enderror" name="category_id">
                                               
                                        </select>
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Kategori
                                        </small>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="publish_at">
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Dibuat pada
                                        </small>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-4">
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
                                <textarea class="form-control" name="body" rows="5" id="task-textarea">{!! $post->body !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-globe"></i> Publish</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
@include('components.backend.ckeditor')

<script>
    $('#formPostUpdate').submit(function(event) {
        event.preventDefault();
        let from = $(this)[0];
        let data = new FormData(from);

        $.ajax({
        url: BaseUrl+'/api/admin/posts/{{ $post->slug }}',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: response.responseJSON.message,
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/post');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
    });
    });
</script>

<script>
    $.ajax({
        url: BaseUrl+'/api/admin/categories',
        method: 'GET',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 200) {
                let data = response.responseJSON.data;
                let append = '';
                $.each(data, (k, v) => {
                    append += '<option value='+ v.id +'>' + v.name + '</option>'
                });
                $('select[name=category_id]').html(append);
            }else {
                console.log('Gagal');
            }
        }
    });
</script>
@endpush