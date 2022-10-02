@extends('layouts.frontend.appv2')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Kurikulum</h3>
    @endslot
@endcomponent
@component('components.frontend.page_content')
@slot('page_content')
<section class="blog__area">
  <div class="container">
    <div class="row">
      <div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
        <div class="lh-1">
          <h1 class="h6 mb-0 text-white lh-1">Kurikulum Konsorsium Biologi Indonesia</h1>
        </div>
    </div>
    <div>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Kurikulum</th>
                      <th class="text-center">Tanggl Unggah</th>
                      <th class="text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody>
  
              </tbody>
          </table>
        </div>
      </div>
  </div>
    </div>
  </div>
</section>


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
    ajax: {
      url: BaseUrl+'/api/user/kurikulum',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      method: 'POST'
    }, 
    language: {
    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
    },
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'title', name: 'title'},
      {data: 'created_at', name: 'created_at'},
      {
        "render": function ( data, type, row ) {
        return `
        @auth
        <div class="text-center">
        <a href="/storage/kurikulum/` + row.file_kurikulum +`" type="button" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-eye text-white"></i></a>
        </div>
        @else
        <div class="text-center">
          <a href="{{ route('login') }}" type="button" class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
        </div>
        @endauth
        ` }
      }
    ]
  });
  setInterval(() => {
      table.ajax.reload();
  }, 30000);

  // $('#dataTable_filter label ').html('')
</script>
@endpush