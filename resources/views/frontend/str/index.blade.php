@extends('layouts.frontend.app')
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3>{{ __('KOBI| Pengajuan STR') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Beranda') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Pengajuan STR') }}</li>
        </ol>
    </nav>
    </div>
    @endslot
@endcomponent

@component('components.frontend.page_content')
@slot('page_content')
<div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1">{{ __('Formulir Pengajuan STR') }}</h1>
    </div>
    <div class="lh-1 ms-auto">
      <a href="https://kobi-indonesia.id/" class="text-decoration-none"><h1 class="h6 mb-0 text-white lh-1 ">{{ __('Kembali') }}</h1></a>
    </div>
  </div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Alur Permohonan STR (Surat Tanda Registrasi)</h6>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#F8A683"/><text x="50%" y="50%" fill="#fff" dy=".3em">1</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">{{ __('Pemohon Mengisi Data Diri Berupa') }}</strong>
        Nama, Nama Program Studi, Nama Universitas, No HP, Email dan Perusahaan tempat bekerja/perusahaan yang akan dilamar yang menghendaki STR
      </p>
    </div>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#F8A683"/><text x="50%" y="50%" fill="#fff" dy=".3em">2</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">Mengunggah Dokumen Berupa</strong>
        ijazah, surat permohonan, dan surat pengantar dari perusahaan tempat bekerja/perusahaan yang akan dilamar yang menghendaki persyaratan STR. <span class="fw-bold">Dokumen harus berupa PDF</span>
      </p>
    </div>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#F8A683"/><text x="50%" y="50%" fill="#fff" dy=".3em">3</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">Pengajuan akan diverifikasi oleh Admin KOBI.</strong>
        Apabila lolos verifikasi akan diajukan ke Ketua Kobi. Apabila Ketua KOBI menyetujui, maka pengajuan diteruskan kepada Sekretaris KOBI untuk pembuatan STR. Apabila ditolak, maka pemohon harap melengkapi dokumen yang diminta melalui e-mail. 
      </p>
    </div>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#F8A683"/><text x="50%" y="50%" fill="#fff" dy=".3em">4</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">Jika disetujui, pemohon akan diminta untuk membayar biaya pembuatan STR </strong>
        sebesar <span class="fw-bold">Rp250.000,00</span> ke nomor rekening <span class="fw-bold">Bank BNI 0360292082 a.n. Lisna Hidayati</span> dan dibuktikan dengan mengunggah bukti bayar berupa foto/tangkapan layar bukti bayar dalam pilihan menu <span class="fw-bold">Unggah Bukti Pembayaran STR</span>
      </p>
    </div>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#F8A683"/><text x="50%" y="50%" fill="#fff" dy=".3em">5</text></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">Setelah proses pembayaran selesai,</strong>
        maka STR yang telah diterbitkan dapat dikirimkan kepada pemohon melalui <span class="fw-bold">e-mail</span>
      </p>
    </div>
  </div>
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <div id="alert"></div>
    <h6 class="border-bottom pb-2 mb-0">{{ __('Silahkan mengisi formulir di bawah ini :') }}</h6>
    <form id="store">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label mt-3">Nama</label>
        <input type="text" class="form-control" id="name" name="nama" required>
      </div>
      <div class="mb-3">
        <label for="programStudi" class="form-label">{{ __('Nama program studi') }}</label>
        <input type="text" class="form-control" id="programStudi" name="program_studi" required>
      </div>
      <div class="mb-3">
        <label for="university" class="form-label">Nama Universitas</label>
        <input type="text" class="form-control" id="university" name="universitas" required>
      </div>
      <div class="mb-3">
        <label for="phoneNumber" class="form-label">No HP</label>
        <input type="number" class="form-control" id="phoneNumber" name="no_hp" required> 
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="company" class="form-label">{{ __('Nama Perusahaan') }}</label>
        <input type="text" class="form-control" id="company" name="nama_perusahaan" required>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <label for="ijazah" class="form-label">Ijazah</label>
            <input type="file" class="form-control" id="ijazah" name="ijazah" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <label for="suratPermohonan" class="form-label">Surat permohonan</label>
            <input type="file" class="form-control" id="suratPermohonan" name="surat_permohonan" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <label for="suratPengantar" class="form-label">Surat pengantar dari perusahaan</label>
            <input type="file" class="form-control" id="suratPengantar" name="surat_pengantar" required>
          </div>
        </div>
      </div>
      <button id="btnSend" type="submit" id="tunggu" class="w-btn w-btn" type="button">Ajukan</button>
    </form>
    <button id="btnSending" class="w-btn w-btn" type="button" disabled style="display: none">Ajukan...
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      <span class="sr-only">Loading...</span>
    </button>
  </div>
</div>
@endslot
@endcomponent
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
<script>
  $("#store").submit(function(event){
      event.preventDefault();

      $('#btnSend').attr('style', 'display: none');
      $('#btnSending').removeAttr('style', 'display: none');

      var form = $(this)[0];
      var data = new FormData(form);
  
      $.ajax({
        url: BaseUrl+'/api/pengajuan-str',
        method: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        complete: function(response){
          if(response.status == 201) {

            $('#btnSend').removeAttr('style', 'display: none');
            $('#btnSending').attr('style', 'display: none');
            
                swal({
                    title: "",
                    text: 'Terimakasih. Pengajuan STR Anda telah terkirim. Silahkan cek email Anda',
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
      });
  });

</script>
@endpush