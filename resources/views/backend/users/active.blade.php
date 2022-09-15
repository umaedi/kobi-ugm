@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col-sm-12">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="h5 mb-0 text-gray-800 d-inline">Filter dan Export data</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tampilkan berdasarkan tahun</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option>--Pilih tahun--</option>
                      <?php $start = date('Y'); $end = 2019 ?>
                      <?php for($i = $end; $i <= $start; $i++) { ?> 
                        <option value="{{ $i }}">{{ $i }}</option>
                      <?php } ?>
                    </select>
                  </div>
            </div>
            <div class="col-md-4">
            <form action="{{ route('export.excel') }}" method="POST">
              @csrf
                  <div class="form-group">
                      <label for="exampleFormControlSelect1">Export data</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="data">
                        <option>--Pilih tahun--</option>
                        <?php $start = date('Y'); $end = 2019 ?>
                        <?php for($i = $end; $i <= $start; $i++) { ?> 
                          <option value="{{ $i }}">{{ $i }}</option>
                        <?php } ?>
                      </select>
                    </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label for="">Aksi</label>
                      <button type="submit" class="btn btn-primary form-control">Export</button>
                  </div>
            </form>
              </div>
        </div>
    </div>
</div>
  @component('components.backend.card-table')
    @slot('header')
      <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">List Anggota Aktif</h3>
    @endslot
    @slot('dropdown')
      <div class="dropdown-header">Dropdown Header:</div>
      <button class="dropdown-item" onclick="reloadDataTable()">Muat ulang table</button>
      <div class="dropdown-divider"></div>
    @endslot
    @slot('thead')
      <tr>
        <th>No</th>
        <th>Nama Univ</th>
        <th>Nama Jurusan</th>
        <th>Email Kaprodi</th>
        <th>Action</th>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  let table = $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: BaseUrl+'/api/admin/users/active',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'nama_univ', name: 'nama_univ'},
      {data: 'nama_jurusan', name: 'nama_jurusan'},
      {data: 'email_kaprodi', name: 'email_kaprodi'},
      {
        "render": function ( data, type, row ) {
        return `
        <a href="/admin/anggota/aktif/detail/`+ row.id +`" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
        ` }
      }
    ]
  });

  function reloadDataTable(){
    table.ajax.reload();
  }

  setInterval(() => {
      table.ajax.reload();
  }, 30000);
</script>
@endpush