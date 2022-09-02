@extends('layouts.backend.app')
@push('css')
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
              <h3 class="h5 mb-0 text-gray-800 d-inline">Kurikulum</h3>
        </div>
        <form id="formPost">
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control @error('title') ? is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="title">Thumbnail</label>
                        <input type="file" class="form-control @error('image') ? is-invalid @enderror" name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                <textarea class="form-control" name="body" rows="5" id="task-textarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-globe"></i> Publish</button>
        </div>
    </form>
    </div>
    @component('components.backend.card-table')
    @slot('header')
      <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Kurikulum</h3>
    @endslot
    @slot('dropdown')
      <div class="dropdown-header">Dropdown Header:</div>
      <button class="dropdown-item" onclick="reloadDataTable()">Muat ulang table</button>
      <div class="dropdown-divider"></div>
    @endslot
    @slot('thead')
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Dibuat pada</th>
        <th>Aksi</th>
      </tr>
    @endslot
    @slot('tbody')
    
    @endslot      
  @endcomponent
</div>
@endsection
@push('js')
@include('components.backend.ckeditor')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
<script>
        $('#formPost').submit(function(event) {
        event.preventDefault();
        let from = $(this)[0];
        let data = new FormData(from);

        $.ajax({
        url: BaseUrl+'/api/admin/kurikulum',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Kurikulum berhasil diterbitkan",
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
<script>
    let table = $("#dataTable").DataTable({
      processing: true,
      serverSide: true,
      ajax: BaseUrl+'/api/admin/kurikulum',
      columns: [
        {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
        {data: 'title', name: 'title'},
        {data: 'publish_at', name: 'publish_at'},
        {
          "render": function ( data, type, row ) {
          return `
          <a href="/` + row.slug +`" type="button" target='_blank' class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
          <a href="kurikulum/` + row.id +`" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
          <button id="delete" data-id="`+ row.id +`" type="button" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
          ` }
        }
      ]
    });
    $('#dataTable tbody').on('click', '#delete', function(){
      let id = $(this).data('id');
      remove(id);
    }); 
    function remove(id) {
      swal({
          title: "",
          text: "Hapus kurikulum?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          })
          .then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  url: BaseUrl+'/api/admin/kurikulum/'+id,
                  method: 'DELETE',
                  processData: false,
                  contentType: false,
                  cache: false,
                  complete: (response) => {
                      if(response.status == 200) {
                          table.ajax.reload();
                      }else {
                          console.log(response.responseJSON.message);
                      }
                  }
                  });
                  swal("Kurikulum berhasil dihapus", {
                  icon: "success",
              });
          }
      });
    }
  
    function reloadDataTable(){
      table.ajax.reload();
    }
  
    setInterval(() => {
        table.ajax.reload();
    }, 30000);
  </script>
@endpush