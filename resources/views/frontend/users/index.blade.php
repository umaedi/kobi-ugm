@extends('layouts.frontend.appv2')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Daftar Anggota Aktif KOBI</h3>
    @endslot
@endcomponent
@component('components.frontend.page_content')
@slot('page_content')
<div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1" id="table-head">Daftar Anggota Aktif KOBI Tahun {{ date('Y') }}</h1>
    </div>
</div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <select class="form-control" id="show-data-by-year" name="filter-data" onchange="filterData(`${this.value}`)">
    <option value="{{ date('Y') }}">Tampilkan data berdasarkan tahun</option>
      <?php $start = date('Y'); $end = 2019 ?>
      <?php for($i = $end; $i <= $start; $i++) { ?> 
        <option value="{{ $i }}">{{ $i }}</option>
      <?php } ?>
  </select>
</div>
<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
                <tr>
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>Universitas</th>
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    </div>
</div>
@endslot
@endcomponent
@endsection
@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>

  let table = $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    language: {
    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
    },
    ajax: {
        url:  BaseUrl+'/api/user/list/active',
        method: 'POST',
        data: (data) => {
        data.tahun = $('select[name=filter-data]').val();
      }
    },
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'no_anggota', name: 'no_anggota'},
      {data: 'nama_univ', name: 'nama_univ'},
      {data: 'nama_fakultas', name: 'nama_fakultas'},
      {data: 'nama_jurusan', name: 'nama_jurusan'},
    ],
  });
  
  function filterData(value){
    table.ajax.reload(false, null);
    $('#table-head').html('Daftar Anggota Aktif KOBI Tahun '+ value);
  }

  setInterval(() => {
      table.ajax.reload();
  }, 30000);

</script>
@endpush