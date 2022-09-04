@extends('layouts.frontend.appv2')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Persayaratan</h3>
    @endslot
@endcomponent
@component('components.frontend.page_content')
@slot('page_content')
<section class="blog__area">
  <div class="container">
    <div class="row">
      <div class="d-flex align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
        <div class="lh-1">
          <h1 class="h6 mb-0 text-white lh-1">Persyaratan Permohonan STR (Surat Tanda Registrasi)</h1>
        </div>
        <div class="lh-1 ms-auto">
          <a href="{{ url('/') }}" class="text-decoration-none"><h1 class="h6 mb-0 text-white lh-1 ">Kembali</h1></a>
        </div>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="d-flex text-muted pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#063E85"/><text x="50%" y="50%" fill="#fff" dy=".3em">1</text></svg>
          <p class="pb-3 mb-0 lh-sm border-bottom">
            <strong class="d-block text-gray-dark">{{ __('Pemohon Mengisi Data Diri Berupa') }}</strong>
            Nama, Nama Program Studi, Nama Universitas, No HP, Email dan Perusahaan tempat bekerja/perusahaan yang akan dilamar yang menghendaki STR
          </p>
        </div>
        <div class="d-flex text-muted pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#063E85"/><text x="50%" y="50%" fill="#fff" dy=".3em">2</text></svg>
          <p class="pb-3 mb-0 lh-sm border-bottom">
            <strong class="d-block text-gray-dark">Mengunggah Dokumen Berupa</strong>
            ijazah, surat permohonan, dan surat pengantar dari perusahaan tempat bekerja/perusahaan yang akan dilamar yang menghendaki persyaratan STR. <span class="fw-bold">Dokumen harus berupa PDF</span>
          </p>
        </div>
        <div class="d-flex text-muted pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#063E85"/><text x="50%" y="50%" fill="#fff" dy=".3em">3</text></svg>
          <p class="pb-3 mb-0 lh-sm border-bottom">
            <strong class="d-block text-gray-dark">Pengajuan akan diverifikasi oleh Admin KOBI.</strong>
            Apabila lolos verifikasi akan diajukan ke Ketua Kobi. Apabila Ketua KOBI menyetujui, maka pengajuan diteruskan kepada Sekretaris KOBI untuk pembuatan STR. Apabila ditolak, maka pemohon harap melengkapi dokumen yang diminta melalui e-mail. 
          </p>
        </div>
        <div class="d-flex text-muted pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#063E85"/><text x="50%" y="50%" fill="#fff" dy=".3em">4</text></svg>
          <p class="pb-3 mb-0 lh-sm border-bottom">
            <strong class="d-block text-gray-dark">Jika disetujui, pemohon akan diminta untuk membayar biaya pembuatan STR </strong>
            sebesar <span class="fw-bold">Rp250.000,00</span> ke nomor rekening <span class="fw-bold">Bank BNI 0360292082 a.n. Lisna Hidayati</span> dan dibuktikan dengan mengunggah bukti bayar berupa foto/tangkapan layar bukti bayar dalam pilihan menu <span class="fw-bold">Unggah Bukti Pembayaran STR</span>
          </p>
        </div>
        <div class="d-flex text-muted pt-3">
          <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#063E85"/><text x="50%" y="50%" fill="#fff" dy=".3em">5</text></svg>
          <p class="pb-3 mb-0 lh-sm border-bottom">
            <strong class="d-block text-gray-dark">Setelah proses pembayaran selesai,</strong>
            maka STR yang telah diterbitkan dapat dikirimkan kepada pemohon melalui <span class="fw-bold">e-mail</span>
          </p>
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
    ajax: BaseUrl+'/api/admin/publikasi',
    columns: [
      {data: null, render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; }},
      {data: 'nama_dokumen', name: 'nama_dokumen'},
      {data: 'publish_at', name: 'publish_at'},
      {
        "render": function ( data, type, row ) {
        return `
        @auth
        <div class="text-center">
        <a href="/storage/publikasi/` + row.file_dokumen +`" type="button" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-eye text-white"></i></a>
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