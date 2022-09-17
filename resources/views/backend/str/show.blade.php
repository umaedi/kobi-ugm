@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Detail Pengajuan STR</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Nama') }}</label>
                        <input type="text" class="form-control my-colorpicker1"value="{{ $str->nama }}">
                    </div>
                      <div class="form-group">
                        <label>{{ __('Universitas') }}</label>
                        <input type="text" class="form-control my-colorpicker1" value="{{ $str->universitas }}">
                      </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Program Studi') }}</label>
                        <input type="text" class="form-control my-colorpicker1"  value="{{ $str->program_studi }}">
                    </div>
                    <div class="form-group">
                        <label>{{ __('No HP') }}</label>
                        <input type="text" class="form-control my-colorpicker1" value="{{ $str->no_hp }}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input type="text" class="form-control my-colorpicker1"  value="{{ $str->email }}">
                      </div>
                      <div class="form-group mb-4">
                        <label>{{ __('Nama Perusahaan') }}</label>
                        <input type="text" class="form-control my-colorpicker1" value="{{ $str->nama_perusahaan }}">
                      </div>
                      <hr>
                      <div class="form-group d-flex">
                          <form id="verifStr">
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Surat Permohonan') }}</label>
                        <a href="{{ asset('storage/docstr/' . $str->surat_permohonan) }}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">lihat Surat Permohonan</a>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Surat Pengantar') }}</label>
                        <a href="{{ asset('storage/docstr/' . $str->surat_pengantar) }}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">Lihat Surat Pengantar</a>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Ijazah') }}</label>
                        <a href="{{ asset('storage/docstr/' . $str->ijazah) }}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">lihat Ijazah</a>
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
      url: BaseUrl+'/api/admin/str/update/{{ $str->id }}',
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
                  window.location.replace(BaseUrl+'/admin/str/verif');
                });
          }else {
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
      url: BaseUrl+'/api/admin/str/update/{{ $str->id }}',
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
                url: BaseUrl+'/api/admin/str/destroy/{{ $str->id }}',
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