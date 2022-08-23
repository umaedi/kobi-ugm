@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <div class="col-sm-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Tambah Naskah Akademik</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="formPublikasi">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <input name="nama_dokumen" type="text" class="form-control" placeholder="Nama naskah">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <input name="file_dokumen" type="file" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <input name="publish_at" type="date" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>
    @component('components.backend.card-table')
        @slot('header')
        <h3 class="h5 mb-0 text-gray-800 d-inline">List Naskah Akademik</h3>
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
@push('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Publikasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdatePublikasi">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="idPublikasi">
                <div class="form-group">
                    <input type="text" name="nama_dokumen" class="form-control" id="namaDokuemn">
                </div>
                <div class="form-group">
                    <input type="file" name="file_dokumen" class="form-control">
                </div>
                <div class="form-group">
                    <input type="date" name="publish_at" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Update</button>
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
            ajax: BaseUrl+'/api/admin/naskah',
            columns: [
                {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
                {data: 'nama_dokumen', name: 'nama_dokumen'},
                {data: 'publish_at', name: 'publish_at'},
                {
                    "render": function ( data, type, row ) {
                    return `
                    <a href="{{ asset('storage/naskah') }}/` + row.file_dokumen +`" target='_blank' type="button" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
                    <button id="edit" data-id="`+ row.id +`" data-nama_dokumen="`+ row.nama_dokumen +`" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></button>
                    <button id="delete" data-id="`+ row.id +`" type="button" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                    ` }
                }
            ]
        });

        $('#formPublikasi').submit(function (event) {
            event.preventDefault();
            
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/naskah',
                data: data,
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                complete: function (response) {
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
        
        $('#dataTable tbody').on('click', '#edit', function() {
            let nama_dokumen = $(this).data('nama_dokumen');
            let id = $(this).data('id');
            $('input[id=namaDokuemn]').val(nama_dokumen);
            $('input[name=idPublikasi]').val(id);
        });
        
        $('#formUpdatePublikasi').submit(function (event) {
            event.preventDefault();
            $('#exampleModal').modal('hide');

            const id = $('input[name=idPublikasi]').val();
            const form = $(this)[0];
            const data = new FormData(form);

            $.ajax({
                url: BaseUrl+'/api/admin/naskah/'+id,
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
        text: "Hapus naskah ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/naskah/'+id,
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
                swal("Naskah berhasil dihapus", {
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