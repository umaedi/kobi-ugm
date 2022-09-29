@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<div class="container-fluid">

  @component('components.backend.card-table')
    @slot('header')
      <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Berita Kegiatan</h3>
    @endslot
    @slot('dropdown')
      <div class="dropdown-header">Dropdown Header:</div>
      <button class="dropdown-item" onclick="reloadDataTable()">Muat ulang table</button>
      <div class="dropdown-divider"></div>
    @endslot
    @slot('thead')
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Dibuat pada</th>
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
    ajax: BaseUrl+'/api/admin/event',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'title', name: 'title'},
      {data: 'event_category.name', name: 'event_category.name'},
      {data: 'publish_at', name: 'publish_at'},
      {
        "render": function ( data, type, row ) {
        return `
        <a href="/event/show/` + row.slug +`" type="button" target='_blank' class="btn btn-sm btn-success"><i class="fas fa-eye text-white"></i></a>
        <a href="/admin/event/edit/` + row.id +`" type="button" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
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
        text: "Hapus ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/event/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                swal("Berita kegiatan berhasil dihapus", {
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