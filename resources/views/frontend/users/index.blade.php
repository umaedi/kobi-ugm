@extends('layouts.frontend.appv2')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Anggota KOBI</h3>
    @endslot
@endcomponent
@component('components.frontend.page_content')
@slot('page_content')
<div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1">Anggota KOBI</h1>
    </div>
    <div class="lh-1 ms-auto">
      <a href="{{ url('/') }}" class="text-decoration-none"><h1 class="h6 mb-0 text-white lh-1 ">Kembali</h1></a>
    </div>
  </div>
<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
                <tr>
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                    <th>Universitas</th>
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

function getDataUsers(search) {

  let table = $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: BaseUrl+'/api/list-anggota',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'user_id', name: 'user_id'},
      {data: 'nama_jurusan', name: 'nama_jurusan'},
      {data: 'nama_fakultas', name: 'nama_fakultas'},
      {data: 'nama_univ', name: 'nama_univ'},
    ]
  });
}
getDataUsers();
  
  setInterval(() => {
      table.ajax.reload();
  }, 30000);

</script>
@endpush