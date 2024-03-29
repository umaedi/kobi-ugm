@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Detail Anggota Yang Ditolak</h3>
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
                    <input name="provinsi" type="email" class="form-control" id="email" value="@isset($anggota->province->name) @endisset">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kota" class="form-label mt-3">{{ __('Kabupaten/Kota') }}</label>
                    <input name="kabupaten" type="email" class="form-control" id="email" value="@isset($anggota->regency->name) @endisset">
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
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="pos" class="form-label mt-3">{{ __('Kode Pos') }}</label>
                    <input name="kode_pos" type="number" class="form-control" id="pos" value="{{ $anggota->kode_pos }}">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label for="no_anggota" class="form-label mt-3">{{ __('Nomor Anggota') }}</label>
                    <input name="no_anggota" type="text" class="form-control" id="no_anggota" value="{{ $anggota->no_anggota }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mt-3">
                    <label for="formFile" class="form-label">{{ __('Lihat Bukti Pembayaran') }}</label>
                    <a href="{{ asset('storage/strukpembayaran/' . $anggota->bukti_pembayaran) }}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">lihat</a>
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
          @method('PUT')
            <div class="modal-body">
                <input type="hidden" name="status" value="2">
                <div class="form-group">
                    <textarea type="text" name="pesan" class="form-control" id="namaDokuemn" rows="10"></textarea>
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
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: data,
      method: 'POST',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
          if(response.status == 201) {
            sendEmail(response.responseJSON.data);
            $('#btnSend').removeAttr('style', 'display: none');
            $('#btnSending').attr('style', 'display: none');
            
              swal({
                  title: "",
                  text: "Anggota berhasil di konfirmasi",
                  icon: "success"
                })
                .then(() => {
                  window.location.replace(BaseUrl+'/admin/anggota/aktif');
                });
          }else {
              $('#btnSend').removeAttr('style', 'display: none');
              $('#btnSending').attr('style', 'display: none');
              swal("", response.responseJSON.message, "warning");
          }
      }
    });

    function sendEmail(data) {
      $.ajax({
        url: BaseUrl+'/api/admin/sendmail/verif-user',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {email: data.email, noAnggota: data.noAnggota, password: data.password},
        method: 'post',
        complete: (res) => {
          if(res.status == 200) {
            console.log('Email terkirim ke '+data.email);
          }
        }
      });
    }
    
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
      url: BaseUrl+'/api/list-anggota/{{ $anggota->id }}',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: data,
      method: 'POST',
      processData: false,
      contentType: false,
      cache: false,
      complete: (response) => {
          if(response.status == 201) {
            sendEmail(response.responseJSON.data);
            $('#btnSendRjt').removeAttr('style', 'display: none');
            $('#btnSendingRjt').attr('style', 'display: none');

              swal({
                  title: "",
                  text: "Anggota ditolak",
                  icon: "success"
                })
                .then(() => {
                  window.location.replace(BaseUrl+'/admin/anggota/ditolak');
                });
          }else {
              $('#btnSendRjt').removeAttr('style', 'display: none');
              $('#btnSendingRjt').attr('style', 'display: none');
              swal("", response.responseJSON.message, "warning");
          }
      }
    });

    function sendEmail(data) {
      $.ajax({
        url: BaseUrl+'/api/admin/sendmail/recjct-user',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {email: data.email, message: data.message},
        method: 'POST',
        complete: (res) => {
          if(res.status == 200) {
            console.log('Email terkirim ke '+data.email);
          }
        }
      });
    }

  });

  //delete STR
  $('#deleteStr').submit(function(event) {
      event.preventDefault();

      swal({
        title: "",
        text: "Hapus Anggota ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/list-anggota/{{ $anggota->id }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                swal("Anggota berhasil dihapus", {
                icon: "success",
            })
            .then(() => {
                window.location.replace(BaseUrl+'/admin/anggota/ditolak');
            });
        }
    });
  });
</script>
@endpush

