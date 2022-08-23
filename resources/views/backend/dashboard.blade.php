@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
  <div class="row">
    
    <?php $data = DB::table('universitas')->count() ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Anggota</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <?php $data = DB::table('posts')->count() ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                              Berita/Artikel</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-fw fa-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <?php $data = DB::table('strs')->count() ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengajuan STR</div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $data }}</div>
                              </div>
                              <div class="col">
                                  <div class="progress progress-sm mr-2">
                                      <div class="progress-bar bg-info" role="progressbar"
                                          style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                          aria-valuemax="100"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <?php $data = DB::table('laporans')->count() ?>
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              Laporan Kegiatan</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Content Row -->

  <div class="row">
      <!-- Pie Chart -->
      <div class="col-xl-12 col-lg-12">
        @component('components.backend.card-table')
        @slot('header')
        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Pengajuan STR Terbaru</h3>
        @endslot
        @slot('dropdown')
            <div class="dropdown-header">Dropdown Header:</div>
            <button class="dropdown-item" reloadActiveUser()>Muat ulang table</button>
            <div class="dropdown-divider"></div>
        @endslot
        @slot('thead')
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Program studi</th>
            <th>Universitas</th>
            <th>Aksi</th>
          </tr>
        @endslot
        @slot('tbody')

        @endslot
    @endcomponent
      </div>
  </div>
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
    ajax: BaseUrl+'/api/admin/str',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'nama', name: 'nama'},
      {data: 'program_studi', name: 'program_studi'},
      {data: 'universitas', name: 'universitas'},
      {
      "render": function ( data, type, row ) {
        return `
        <a href="/admin/str/show/` + row.id +`" type="button" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
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


