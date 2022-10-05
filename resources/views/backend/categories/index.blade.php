@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Tambah kategori baru</h3>
        </div>
        <div class="card-body">
            <form id="formCategory">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-update btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @component('components.backend.card-table')
        @slot('header')
        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">List kategori</h3>
        @endslot
        @slot('dropdown')
        <div class="dropdown-header">Dropdown Header:</div>
        <button onclick="reload()" class="dropdown-item">Muat ulang table</button>
        <div class="dropdown-divider"></div>
      @endslot
        @slot('thead')
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Dibuat pada</th>
            <th>Aksi</th>
          </tr>
        @endslot
        @slot('tbody')

        @endslot
    @endcomponent
</div>
@endsection
@push('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="updateCategory">
            <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <input type="text" name="name" class="form-control category-name" id="category">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Gagal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </form>
      </div>
    </div>
  </div>
@endpush
@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
    <script>
        let table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: BaseUrl+'/api/admin/categories',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST'
            },
            columns: [
                {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'created_at', name: 'created_at'},
                {
                    "render": function ( data, type, row ) {
                    return `
                    <a href="/posts/category/` + row.slug +`" type="button" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
                    <button id="edit" data-id="`+ row.id +`" data-category="`+ row.name +`" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></button>
                    ` }
                }
            ]
        });

        $('#formCategory').submit( function(event) {
            event.preventDefault();
            
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/categories/store',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                complete: function (response) {
                    if(response.status == 201) {
                        swal("", "Kategori berhasil dibuat", "success");
                        table.ajax.reload();
                        $('input[name=category]').val('');
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
            });
        });
        
        $('#dataTable tbody').on('click', '#edit', function() {
            let category = $(this).data('category');
            let id = $(this).data('id');
            $('input[name=id]').val(id);
            $('input.category-name').val(category);
        });

        $('#updateCategory').submit(function(event) {
            event.preventDefault();
            $('#exampleModal').modal('hide');
            table.ajax.reload();
        });

        $('#dataTable tbody').on('click', '#delete', function() {
            let id = $(this).data('id');
            remove(id);
        });

        $('#updateCategory').submit(function(e) {
            e.preventDefault();

            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/categories/update',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 201) {
                        swal("", "Kategori berhasil diperbaharui", "success");
                        table.ajax.reload();
                        $('input[name=category]').val('');
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
            });
        });

        function remove(id){
        swal({
        title: "",
        text: "Hapus kategori ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/categories/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                        table.ajax.reload();
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
                });
                swal("Kategori berhasil dihapus", {
                icon: "success",
            });
        }
        });  
    }

    function reload(){
        table.ajax.reload(null, false);
    }

    setInterval(() => {
        table.ajax.reload();
    }, 30000);
    </script>
@endpush