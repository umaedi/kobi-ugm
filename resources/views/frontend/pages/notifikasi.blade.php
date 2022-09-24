@extends('layouts.frontend.appv2')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.table.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@component('components.frontend.breadcrumb')
    @slot('breadcrumb')
    <div class="page__title-wrapper text-center">
    <h3 class="fw-bold">Pendaftaran</h3>
    @endslot
@endcomponent
@component('components.frontend.page_content')
@slot('page_content')
<section class="blog__area">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center align-items-center p-3 my-1 text-white bg-success rounded shadow-sm">
                <div class="lh-1 ">
                  <h1 class="h4 mb-0 text-white lh-1">Pendaftaran Anda berhasil</h1>
                </div>
        </div>
        <div class="my-3 p-3 bg-body rounded shadow-sm text-center">
          <img class="lazyload" data-src="{{ asset('frontend') }}/img/notif/notif.png" alt="" width="50%">
            <p class="text-center mt-3">Termikasih telah mendaftar menjadi bagian dari KOBI. Selanjutnya Admin akan mengirimkan no anggota pada email yang telah Anda daftarkan</p>
            <a href="{{ url('/') }}" class="w-btn w-btn">Kembali</a>
        </div>
    </div>
    </div>
    </div>
  </div>
</section>


@endslot
@endcomponent
@endsection