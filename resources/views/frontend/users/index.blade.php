@extends('layouts.frontend.appv2')
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
  <div class="row mt-50">
    <div class="col-md-2">
          <?php $start = date('Y'); $end = 2016?>
          <select class="form-control" name="year">
          <option selected value="{{ date('Y') }}">Pilih tahun</option>
          <?php for($i=$end; $i<=$start; $i++) { ?>
             <option value="{{ $i }}"> <?php echo ucwords($i); ?> </option>
          <?php } ?>
          </select>
    </div>
    <div class="col-md-2 x-tampil-data">
       <button type="submit" class="w-btn w-btn" onclick="filterYear()">Tampilkan</button>
    </div>
    <div class="col-md-2">
      <select type="text" class="form-control" name="render">
          <option value="10">Jumlah data</option>
          <option value="10">10</option>
          <option value="50">50</option>
          <option value="100">100</option>
      </select>
    </div>
    <div class="col-md-2 x-tampil-data">
      <button type="submit" class="w-btn w-btn" onclick="getLength()">Tampilkan</button>
   </div>
    <div id="dataTable_filter" class="col-md-2 dataTables_filter" >
      <input type="search" name="search" class="form-control" placeholder="Cari anggota disini" aria-controls="dataTable">
    </div>
    <div class="col-md-2 x-tampil-data">
      <button type="submit" class="w-btn w-btn" onclick="searchData()">Cari</button>
   </div>
 </div>

<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Universitas</th>
                <th scope="col">Fakultas</th>
                <th scope="col">Program Studi</th>
                <th scope="col" class="text-center">Jenjang Studi</th>
                <th scope="col" class="text-center">Tahun</th>
              </tr>
            </thead>
            <tbody id="content-users">
              
            </tbody>
          </table>
          <div id="btnMore">
            <div class="d-flex">
              <div class="lh-1 ms-auto">
                <div class="col-md-12 my-2">
                  <button class="w-btn w-btn btn-send" id="loadMore" onclick="loadMore()" data-value="">Lihat lebih banyak</button>
                  <button class="w-btn w-btn" disabled type="button" id="btnSending" style="display: none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Proses...
                  </button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endslot
@endcomponent
@endsection
@push('js')
<script>
  let data = {
    page: '1',
  };
  function getUsers(data){
    $.ajax({
        url: BaseUrl+'/api/user/list/active',
        data: data,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        complete: (response) => {
          if(response.status == 200) {
            let data = response.responseJSON.data.data;
            let no = parseInt(response.responseJSON.data.current_page) * parseInt(response.responseJSON.data.per_page) - response.responseJSON.data.per_page;
            let content = '';
            $.each(data, (k, v) => {
              no++;
              content += '<tr>';
              content += '<th>'+ no + '.' +'</th>';
              content += '<td>'+ v.nama_univ +'</td>';
              content += '<td>'+ v.nama_fakultas +'</td>';
              content += '<td>'+ v.nama_jurusan +'</td>';
              content += '<td class="text-center">'+ v.jenjang +'</td>';
              content += '<td class="text-center">'+ v.thn_anggota +'</td>';
              content += '</tr>';
            });
            $('#content-users').removeAttr('style', 'display: none');
            $('#btnMore').removeAttr('style', 'display: none');
            $('#content-users').append(content);
            $('#loadMore').data('value', response.responseJSON.data.current_page);
            $('#loadMore').removeAttr('style', 'display: none');
            $('#btnSending').attr('style', 'display: none');
          }else {
            $('#content-users').attr('style', 'display: none');
            $('#btnMore').html(`
            <div class="container mt-3">
              <div class="row justify-content-center">
                <div class="col text-center">
                  <h6>Semua data sudah ditampilkan</h6>
                  <button class="w-btn w-btn mt-2" onclick="reloadPage()">Refresh Halaman</button>
                </div>
              </div>
            </div>
            `);
          }
        }
    });
  }
  getUsers(data);

  function loadMore(){
    $('button.btn-send').attr('style', 'display: none');
    $('#btnSending').removeAttr('style', 'display: none');
    var page = parseInt($('#loadMore').data('value')) + 1;
    var data = {
      page: page,
    }
    getUsers(data);
  }

  function filterYear(){
    $('#btnMore').removeClass('d-none');
    $('#content-users').html('');
    var year = $('select[name=year]').val();
    $('#table-head').html('Daftar Anggota Aktif KOBI Tahun ' + year);
    var data = {
      year: year
    }
    getUsers(data);
  }

  function getLength() {
    $('#btnMore').removeClass('d-none');
    $('#content-users').html('');
    var render = $('select[name=render]').val();
    var year = $('select[name=year]').val();
    var data = {
      render: render,
      year: year,
    }
    getUsers(data);
  }

  function searchData(){
    let keyword = $('input[name=search]').val();
    $('#content-users').html('');
    $('#btnMore').addClass('d-none');
    var data = {
      search: keyword,
    }
    getUsers(data);
  }

  function reloadPage(){
    location.reload();
  }
</script>
@endpush