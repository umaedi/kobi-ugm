@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Tambah foto baru</h3>
        </div>
        <div class="card-body">
            <form id="formSubmit">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-update btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
    <script>
        $('#formSubmit').submit(function(event) {
            event.preventDefault();
            
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/add-images',
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
                    window.location.replace(BaseUrl+'/admin/gallery');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
                }
            });
        });
    </script>
@endpush