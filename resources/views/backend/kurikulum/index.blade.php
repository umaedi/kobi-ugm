@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
              <h3 class="h5 mb-0 text-gray-800 d-inline">Update Kurikulum</h3>
        </div>
        <div class="card-body">
            <form id="formUpdateAdArt">
                @method('PUT')
                <div class="row">
                  <input type="hidden" name="idDokumen">
                  <div class="col-md-4">
                    <div class="form-group">
                        <input name="nama_dokumen" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <input name="file_dokumen" type="file" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input name="publish_at" type="date" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    @component('components.backend.card-table')
        @slot('header')
        <h3 class="h5 mb-0 text-gray-800 d-inline">Kurikulum KOBI</h3>
        @endslot
        @slot('dropdown')
        <div class="dropdown-header">Dropdown Header:</div>
        <button onclick="reload()" class="dropdown-item">Muat ulang table</button>
        <div class="dropdown-divider"></div>
      @endslot
        @slot('thead')
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Diunggah Pada</th>
            <th>Aksi</th>
          </tr>
        @endslot
        @slot('tbody')

        @endslot
    @endcomponent
</div>
@endsection
@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
    <script>
        let table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: BaseUrl+'/api/admin/kurikulum',
            columns: [
                {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
                {data: 'nama_dokumen', name: 'nama_dokumen'},
                {data: 'publish_at', name: 'publish_at'},
                {
                    "render": function ( data, type, row ) {
                    return `
                    <a href="{{ asset('storage/documents') }}/` + row.file_dokumen +`" target='_blank' type="button" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
                    <button id="edit" data-id="`+ row.id +`" data-nama_dokumen="`+ row.nama_dokumen +`" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></button>
                    <button id="delete" data-id="`+ row.id +`" type="button" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                    ` }
                }
            ]
        });
        
        $('#dataTable tbody').on('click', '#edit', function() {
            let nama_dokumen = $(this).data('nama_dokumen');
            let id = $(this).data('id');
            $('input[name=nama_dokumen]').val(nama_dokumen);
            $('input[name=idDokumen]').val(id);
        });
        
        $('#formUpdateAdArt').submit(function (event) {
            event.preventDefault();

            const id = $('input[name=idDokumen]').val();
            const form = $(this)[0];
            const data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/kurikulum/'+id,
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
                        });
                        table.ajax.reload();
                        $('input').val('');
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
            });
        });

        $('#dataTable tbody').on('click', '#delete', function() {
            let id = $(this).data('id');
            remove(id);
        });

        function remove(id){
        swal({
        title: "",
        text: "Delete category ?",
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
                        console.log('gagal');
                    }
                }
                });
                swal("Publikasi berhasil dihapus", {
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