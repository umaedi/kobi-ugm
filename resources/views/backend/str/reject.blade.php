@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">

  @component('components.backend.card-table')
    @slot('header')
      <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Pengajuan STR</h3>
    @endslot
    @slot('dropdown')
      <div class="dropdown-header">Dropdown Header:</div>
      <button class="dropdown-item" onclick="reloadDataTable()">Muat ulang table</button>
      <div class="dropdown-divider"></div>
    @endslot
    @slot('thead')
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nama Universitas</th>
        <th>Program Studi</th>
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
  let table = $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: BaseUrl+'/api/admin/str/reject',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'nama', name: 'nama'},
      {data: 'universitas', name: 'universitas'},
      {data: 'program_studi', name: 'program_studi'},
      {
        "render": function ( data, type, row ) {
        return `
        <a href="/admin/str/show/` + row.id  +`" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
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
        text: "Delete STR ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/str/reject/'+id,
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
                swal("You request has ben deleted", {
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