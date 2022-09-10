@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Detail Pengguna Baru</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="univ" class="form-label mt-3">{{ __('Nama Universitas') }}</label>
                    <input name="nama_univ" type="text" class="form-control" id="univ" value="{{ $anggota->nama_univ }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kaprodi" class="form-label mt-3">{{ __('Nama Fakultas') }}</label>
                    <input name="nama_fakultas" type="text" class="form-control" id="kaprodi" value="{{ $anggota->nama_fakultas }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="jurusan" class="form-label mt-3">{{ __('Nama Program Studi/Jurusan') }}</label>
                    <input name="nama_jurusan" type="text" class="form-control" id="jurusan" value="{{ $anggota->nama_jurusan }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="email" class="form-label mt-3">{{ __('Email Kaprodi/Jurusan') }}</label>
                    <input name="email_kaprodi" type="email" class="form-control" id="email" value="{{ $anggota->email_kaprodi }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="email" class="form-label mt-3">{{ __('Email Pendaftar') }}</label>
                    <input name="email_user" type="email" class="form-control" id="email" value="{{ $anggota->email_user }}">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">{{ __('Alamat Pengiriman Sertifikat') }}</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" name="alamat">{{ $anggota->alamat }}</textarea>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="provinsi" class="form-label mt-3">{{ __('Provinsi') }}</label>
                    <input name="provinsi" type="email" class="form-control" id="email" value="{{ $anggota->province->name }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kota" class="form-label mt-3">{{ __('Kabupaten/Kota') }}</label>
                    <input name="kabupaten" type="email" class="form-control" id="email" value="{{ $anggota->regency->name }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="name" class="form-label mt-3">{{ __('Nomor Telepon Program Studi/Jurusan') }}</label>
                    <input name="no_tlp" type="text" class="form-control phone-number" value="{{ $anggota->no_tlp }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="name" class="form-label mt-3">{{ __('Nomor WhatsApp/Narahubung') }}</label>
                    <input name="no_wa" type="text" class="form-control phone-number" value="{{ $anggota->no_wa }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="pos" class="form-label mt-3">{{ __('Kode Pos') }}</label>
                    <input name="kode_pos" type="number" class="form-control" id="pos" value="{{ $anggota->kode_pos }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mt-3">
                    <label for="formFile" class="form-label">{{ __('Lihat Bukti Pembayaran') }}</label>
                    <a href="{{ asset('storage/struk/' . $anggota->bukti_pembayaran) }}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">lihat</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <hr>
                    <div class="form-group d-flex">
                        <form id="verifStr">
                          @method('PUT')
                          <input type="hidden" name="status" value="1">
                          <button id="btnSend" type="submit" class="btn btn-success">Verifikasi</button>
                        </form>
                        <button id="btnSending" class="btn btn-success" type="button" disabled style="display: none">Verifikasi...
                          <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </button>
                        <div class="ml-1">
                          <input type="hidden" name="action" value="2">
                          <button id="btnSendRjt" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Tolak
                            <button id="btnSendingRjt" class="btn btn-warning" type="button" disabled style="display: none">Tolak...
                              <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                            </button>
                          </button>
                        </div>
                        <form id="deleteStr" class="ml-1">
                          @csrf
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Alasan penolakan') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="rejectStr">
            <div class="modal-body">
                <input type="hidden" name="status" value="2">
                <div class="form-group">
                    <textarea type="text" name="pesan" class="form-control" id="namaDokuemn"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Batal') }}</button>
                <button id="btnSendRjt" type="submit" class="btn btn-success">{{ __('Kirim') }}</button>
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
  $('#verifStr').submit(function(event) {
      event.preventDefault();

      $('#btnSend').attr('style', 'display: none');
      $('#btnSending').removeAttr('style', 'display: none');

      const form = $(this)[0];
      const data = new FormData(form);

      $.ajax({
      url: BaseUrl+'/api/list-anggota/{{ $anggota->id }}',
      data: data,
      method: 'POST',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
          if(response.status == 201) {

            $('#btnSend').removeAttr('style', 'display: none');
            $('#btnSending').attr('style', 'display: none');
            
              swal({
                  title: "",
                  text: response.responseJSON.message,
                  icon: "success"
                })
                .then(() => {
                  window.location.replace(BaseUrl+'/admin/users');
                });
          }else {
              $('#btnSend').removeAttr('style', 'display: none');
              $('#btnSending').attr('style', 'display: none');
              swal("", response.responseJSON.message, "warning");
          }
      }
    });
  });

  //rejct STR
  $('#rejectStr').submit(function(event) {
      event.preventDefault();

      $('#btnSendRjt').attr('style', 'display: none');
      $('#btnSendingRjt').removeAttr('style', 'display: none');

      $('#exampleModal').modal('hide');
      const form = $(this)[0];
      const data = new FormData(form);

      $.ajax({
      url: BaseUrl+'/api/admin/anggota/update/{{ $anggota->id }}',
      data: data,
      method: 'POST',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
          if(response.status == 201) {

            $('#btnSendRjt').removeAttr('style', 'display: none');
            $('#btnSendingRjt').attr('style', 'display: none');

              swal({
                  title: "",
                  text: response.responseJSON.message,
                  icon: "success"
                })
                .then(() => {
                  window.location.replace(BaseUrl+'/admin/str/reject');
                });
          }else {
              swal("", response.responseJSON.message, "warning");
          }
      }
    });
  });

  //delete STR
  $('#deleteStr').submit(function(event) {
      event.preventDefault();

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
                url: BaseUrl+'/api/admin/str/destroy/{{ $anggota->id }}',
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                    }else {
                        console.log('gagal');
                    }
                }
                });
                swal("You request has ben deleted", {
                icon: "success",
            })
            .then(() => {
                window.location.replace(BaseUrl+'/admin/str');
            });
        }
    });
  });
</script>
@endpush

