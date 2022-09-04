@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
              <h3 class="h5 mb-0 text-gray-800 d-inline">Kurikulum</h3>
        </div>
        <div class="card-body">
            <form id="formPublikasi">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <input name="title" type="text" class="form-control" placeholder="Nama kurikulum">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <input name="file_kurikulum" type="file" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Pilih tanggal</label>
                        <input name="publish_at" type="date" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    @component('components.backend.card-table')
        @slot('header')
        <h3 class="h5 mb-0 text-gray-800 d-inline">List Kurikulum</h3>
        @endslot
        @slot('dropdown')
        <div class="dropdown-header">Dropdown Header:</div>
        <button onclick="reload()" class="dropdown-item">Muat ulang table</button>
        <div class="dropdown-divider"></div>
      @endslot
        @slot('thead')
        <tr>
            <th>No</th>
            <th>Nama Kurikulum</th>
            <th>Tanggal Unggah</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Update Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdatePublikasi">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="idPublikasi">
                <div class="form-group">
                    <label for="">Nama kurikulum</label>
                    <input type="text" name="title" class="form-control" id="namaDokuemn">
                </div>
                <div class="form-group">
                    <label for="">File kurikulum</label>
                    <input type="file" name="file_kurikulum" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="publish_at" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih status</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                      <option value="1">Publish</option>
                      <option value="0">Draft</option>
                    </select>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </div>
              </div>
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
            ajax: BaseUrl+'/api/admin/kurikulum',
            columns: [
                {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
                {data: 'title', name: 'title'},
                {data: 'publish_at', name: 'publish_at'},
                {
                    "render": function ( data, type, row ) {
                    return `
                    <a href="{{ asset('storage/kurik') }}/` + row.file_kurikulum +`" target='_blank' type="button" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
                    <button id="edit" data-id="`+ row.id +`" data-nama_dokumen="`+ row.title +`" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></button>
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
                url: BaseUrl+'/api/admin/kurikulum',
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
                            text: "Kurikulum berhasil diperbaharui",
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
        text: "Hapus kurikulum ?",
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
                        swal("Kurikulum berhasil dihapus", {
                        icon: "success",
                        });
                        table.ajax.reload();
                    }else {
                        console.log('gagal');
                    }
                }
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