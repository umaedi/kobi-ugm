@extends('layouts.backend.app')
@push('css')
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Surat Keputusan</h3>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formdeclatterUpdate">
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $decLatter->title }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="title">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body"></label>
                            <textarea class="form-control" name="body" rows="5">{{ $decLatter->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn btn-primary"></i> Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Struktur Organiasi</h3>
                        <a href="{{ url('/admin/dashboard') }}" class="d-inline ml-auto btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form id="formStructure">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Jabatan</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="department_id">
                                      <option value="0">Ketua Penasihat</option>
                                      <option value="3">Anggota Penasihat</option>
                                      <option value="1">Ketua Organiasi</option>
                                      <option value="1">Wakil Ketua Organiasi</option>
                                      <option value="4">Sekretais I</option>
                                      <option value="4">Sekretais II</option>
                                      <option value="5">Bendahara I</option>
                                      <option value="5">Bendahara II</option>
                                      <option value="8">Humas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="univ">Universitas</label>
                                    <input type="text" class="form-control" id="univ" name="univ">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="photo" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="foto">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="year-start">Masa jabatan dari tahun</label>
                                    <input type="number" class="form-control" id="year-start" name="year_start">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="year-end">Masa jabatan sampai tahun</label>
                                    <input type="number" class="form-control" id="year-end" name="year_end">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="foto">-</label>
                                    <button type="submit" class="btn btn-primary form-control">Unggah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Dewan Penasihat</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($AdvisorLead as $AdLead)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $AdLead->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Ketua</li>
                          <li class="list-group-item font-weight-bold">{{ $AdLead->name }}</li>
                          <li class="list-group-item">{{ $AdLead->univ ?  $AdLead->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $AdLead->id }}" data-name="{{ $AdLead->name }}" data-position="{{ $AdLead->position }}" data-univ="{{ $AdLead->univ }}" data-ystart="{{ $AdLead->year_start }}" data-yend="{{ $AdLead->year_end }}" data-url="advisor"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $AdLead->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    @foreach ($members as $member)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $member->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Anggota</li>
                          <li class="list-group-item font-weight-bold">{{ $member->name }}</li>
                          <li class="list-group-item">{{ $member->univ ?  $member->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $member->id }}" data-name="{{ $member->name }}" data-position="{{ $member->position }}" data-univ="{{ $member->univ }}" data-ystart="{{ $member->year_start }}" data-yend="{{ $member->year_end }}" data-url="advisor"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $member->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Ketua dan Wakil Ketua</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($structuresLead as $strLead)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $strLead->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $strLead->position ? $strLead->position : '-' }}</li>
                          <li class="list-group-item font-weight-bold">{{ $strLead->name }}</li>
                          <li class="list-group-item">{{ $strLead->univ ?  $strLead->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $strLead->id }}" data-name="{{ $strLead->name }}" data-position="{{ $strLead->position }}" data-univ="{{ $strLead->univ }}" data-ystart="{{ $strLead->year_start }}" data-yend="{{ $strLead->year_end }}"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $strLead->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Sekretaris</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($sekretaris as $sek)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $sek->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $sek->position ? $sek->position : '-' }}</li>
                          <li class="list-group-item font-weight-bold">{{ $sek->name }}</li>
                          <li class="list-group-item">{{ $sek->univ ?  $sek->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $sek->id }}" data-name="{{ $sek->name }}" data-position="{{ $sek->position }}" data-univ="{{ $sek->univ }}" data-ystart="{{ $sek->year_start }}" data-yend="{{ $sek->year_end }}"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $sek->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Bendahara</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($bendahara as $bend)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $bend->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $bend->position ? $bend->position : '-' }}</li>
                          <li class="list-group-item font-weight-bold">{{ $bend->name }}</li>
                          <li class="list-group-item">{{ $bend->univ ?  $bend->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $bend->id }}" data-name="{{ $bend->name }}" data-position="{{ $bend->position }}" data-univ="{{ $bend->univ }}" data-ystart="{{ $bend->year_start }}" data-yend="{{ $bend->year_end }}"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $bend->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Koordinator Wilayah</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <form id="formCoordinator">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Jabatan</label>
                                    <input type="text" class="form-control" id="univ" name="department">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="univ">Universitas</label>
                                    <input type="text" class="form-control" id="univ" name="univ">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="photo" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="foto">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="year-start">Masa jabatan dari tahun</label>
                                    <input type="number" class="form-control" id="year-start" name="year_start">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="year-end">Masa jabatan sampai tahun</label>
                                    <input type="number" class="form-control" id="year-end" name="year_end">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="foto">-</label>
                                    <button type="submit" class="btn btn-primary form-control">Unggah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row justify-content-center">
                    @foreach ($iDbagian as $bagian)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $bagian->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $bagian->department }}</li>
                          <li class="list-group-item font-weight-bold">{{ $bagian->name }}</li>
                          <li class="list-group-item">{{ $bagian->univ }}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $bagian->id }}" data-name="{{ $bagian->name }}" data-department="{{ $bagian->department }}" data-univ="{{ $bagian->univ }}" data-ystart="{{ $bagian->year_start }}" data-yend="{{ $bagian->year_end }}"  data-toggle="modal" data-target="#CoordinatorModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick=" deteleCoor({{ $bagian->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Koordinator Bidang Kurikulum</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="card-body">
                    <form id="formCoordinatorCurriculum">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Jabatan</label>
                                        <input type="text" class="form-control" id="univ" name="department">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="univ">Universitas</label>
                                        <input type="text" class="form-control" id="univ" name="univ">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="photo" required>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="foto">Status</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="year-start">Masa jabatan dari tahun</label>
                                        <input type="number" class="form-control" id="year-start" name="year_start">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="year-end">Masa jabatan sampai tahun</label>
                                        <input type="number" class="form-control" id="year-end" name="year_end">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="foto">-</label>
                                        <button type="submit" class="btn btn-primary form-control">Unggah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row justify-content-center">
                        @foreach ($curriculums as $curriculum)
                        <div class="card mr-3 mt-3" style="width: 18rem;">
                            <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $curriculum->photo) }}">
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item">{{ $curriculum->department }}</li>
                              <li class="list-group-item font-weight-bold">{{ $curriculum->name }}</li>
                              <li class="list-group-item">{{ $curriculum->univ }}</li>
                            </ul>
                            <div class="card-body text-center">
                              <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $curriculum->id }}" data-name="{{ $curriculum->name }}" data-department="{{ $curriculum->department }}" data-univ="{{ $curriculum->univ }}" data-ystart="{{ $curriculum->year_start }}" data-yend="{{ $curriculum->year_end }}"  data-toggle="modal" data-target="#CurriculumCoordinator">Edit</button>
                              <button class="btn btn-sm btn-danger" onclick=" deteleCoor({{ $curriculum->id }})">Hapus</button>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">HUMAS</h3>
                    </div>
                </div>
            </div>
            <!-- Dewan penasihat -->
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($humas as $hum)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $hum->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $hum->position ? $hum->position : '-' }}</li>
                          <li class="list-group-item font-weight-bold">{{ $hum->name }}</li>
                          <li class="list-group-item">{{ $hum->univ ?  $hum->univ : '-'}}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $hum->id }}" data-name="{{ $hum->name }}" data-position="{{ $hum->position }}" data-univ="{{ $hum->univ }}" data-ystart="{{ $hum->year_start }}" data-yend="{{ $hum->year_end }}"  data-toggle="modal" data-target="#exampleModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick="deteletAdvisor({{ $hum->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
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
          <h5 class="modal-title" id="exampleModalLabel">Simpan perubahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdate">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control struck-name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="">Jabatan</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="department_id" required>
                        <option value="0">Ketua Penasihat</option>
                        <option value="3">Anggota Penasihat</option>
                        <option value="1">Ketua Organiasi</option>
                        <option value="1">Wakil Ketua Organisasi</option>
                        <option value="4">Sekretaris I</option>
                        <option value="4">Sekretaris II</option>
                        <option value="5">Bendahara I</option>
                        <option value="5">Bendahara II</option>
                        <option value="8">Humas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Universitas</label>
                    <input type="text" name="univ" class="form-control struck-univ" placeholder="Universitas">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan dari tahun</label>
                    <input type="number" class="form-control year-start" id="year-start" name="year_start" placeholder="Masa jabatan dari tahun">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan sampai tahun</label>
                    <input type="number" class="form-control year-end" id="year-end" name="year_end" placeholder="Masa jabatan sampai tahun">
                </div>
                <div class="form-group">
                    <label for="">Satatus</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="CoordinatorModal" tabindex="-1" role="dialog" aria-labelledby="CoordinatorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CoordinatorLabel">Simpan perubahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdateCoor">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control struck-name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="">Jabatan</label>
                    <input type="text" name="department" class="form-control struck-name department">
                </div>
                <div class="form-group">
                    <label for="">Universitas</label>
                    <input type="text" name="univ" class="form-control struck-univ" placeholder="Universitas">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan dari tahun</label>
                    <input type="number" class="form-control year-start" id="year-start" name="year_start" placeholder="Masa jabatan dari tahun">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan sampai tahun</label>
                    <input type="number" class="form-control year-end" id="year-end" name="year_end" placeholder="Masa jabatan sampai tahun">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="CurriculumCoordinator" tabindex="-1" role="dialog" aria-labelledby="CoordinatorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CoordinatorLabel">Simpan perubahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="FormCurriculumCoordinator">
        @method('PUT')
        <div class="modal-body">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control struck-name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="">Jabatan</label>
                    <input type="text" name="department" class="form-control struck-name department">
                </div>
                <div class="form-group">
                    <label for="">Universitas</label>
                    <input type="text" name="univ" class="form-control struck-univ" placeholder="Universitas">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan dari tahun</label>
                    <input type="number" class="form-control year-start" id="year-start" name="year_start" placeholder="Masa jabatan dari tahun">
                </div>
                <div class="form-group">
                    <label for="">Masa jabatan sampai tahun</label>
                    <input type="number" class="form-control year-end" id="year-end" name="year_end" placeholder="Masa jabatan sampai tahun">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>

<script>
    $('#formdeclatterUpdate').submit(function(event) {
        event.preventDefault();
        let from = $(this)[0];
        let data = new FormData(from);

        $.ajax({
        url: BaseUrl+'/api/admin/declatter/{{ $decLatter->id }}',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Surat keputusan berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
    });
    });

    //structure
    $('#formStructure').submit(function(event){
        event.preventDefault();

        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/structure',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Foto berhasil diunggah",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
        });
    });

    //form department
    $('#formCoordinator').submit(function(event){
        event.preventDefault();

        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/coordinator',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Foto berhasil diunggah",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
        });
    });

    //form coordinator region
    $('#formCoordinatorCurriculum').submit(function(event){
        event.preventDefault();

        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/curriculum-coordinator',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
            if(response.status == 201) {
                swal({
                    title: "",
                    text: "Foto berhasil diunggah",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
            }else {
                swal("", response.responseJSON.message, "warning");
            }
        }
        });
    });

    //update
    $('button.btnEdit').click(function() {
        let id = $(this).data('id')
        let name = $(this).data('name');
        let department = $(this).data('department');
        let univ = $(this).data('univ');
        let ystart = $(this).data('ystart');
        let yend = $(this).data('yend');
        let url = $(this).data('url');

        $('input[name=id]').val(id);
        $('input.struck-name').val(name);
        $('input.department').val(department);
        $('input.struck-univ').val(univ);
        $('input.year-start').val(ystart);
        $('input.year-end').val(yend);
    });

    $('#formUpdateCoor').submit(function() {
        event.preventDefault();
        $('#CoordinatorModal').modal('hide');

        let id = $('input[name=id]').val();
        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/coordinator/'+id,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
                if(response.status == 201) {
                swal({
                    title: "",
                    text: "Koordinator berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
            } 
        });
    });

    //update coordinator curriculum
    $('#FormCurriculumCoordinator').submit(function() {
        event.preventDefault();
        $('#CurriculumCoordinator').modal('hide');

        let id = $('input[name=id]').val();
        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/curriculum-coordinator/'+id,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
                if(response.status == 201) {
                swal({
                    title: "",
                    text: "Koordinator berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
            } 
        });
    });

    $('#formUpdate').submit(function() {
        event.preventDefault();
        $('#exampleModal').modal('hide');

        let id = $('input[name=id]').val();
        let form = $(this)[0];
        let data = new FormData(form);

        $.ajax({
            url: BaseUrl+'/api/admin/structure/'+id,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
                if(response.status == 201) {
                swal({
                    title: "",
                    text: "Koordinator berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
            } 
        });
    });
    

    //delete
    function deteletAdvisor(id){
        swal({
        title: "",
        text: "Hapus photo penasihat ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/structure/'+id,
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                    swal({
                    title: "",
                    text: "Photo berhasil dihapus",
                    icon: "success"
                    })
                    .then((value) => {
                        window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                    });
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
                });
            }
        });  
    }

    function deteleCoor(id){
        swal({
        title: "",
        text: "Hapus photo koordinator ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/coordinator/'+id,
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                    swal({
                    title: "",
                    text: "Photo berhasil dihapus",
                    icon: "success"
                    })
                    .then((value) => {
                        window.location.replace(BaseUrl+'/admin/struktur-organisasi');
                    });
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
                });
            }
        });  
    }
</script>
@endpush