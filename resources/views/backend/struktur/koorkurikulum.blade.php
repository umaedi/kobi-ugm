@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
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
                    @foreach ($structures as $structure)
                    <div class="card mr-3 mt-3" style="width: 18rem;">
                        <img class="card-img-top lazyload" data-src="{{ asset('storage/structure/'. $structure->photo) }}">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">{{ $structure->department }}</li>
                          <li class="list-group-item font-weight-bold">{{ $structure->name }}</li>
                          <li class="list-group-item">{{ $structure->univ }}</li>
                        </ul>
                        <div class="card-body text-center">
                          <button class="btn btn-sm btn-warning btnEdit" data-id="{{ $structure->id }}" data-name="{{ $structure->name }}" data-department="{{ $structure->department }}" data-univ="{{ $structure->univ }}" data-ystart="{{ $structure->year_start }}" data-yend="{{ $structure->year_end }}"  data-toggle="modal" data-target="#structureModal">Edit</button>
                          <button class="btn btn-sm btn-danger" onclick=" deletePhoto({{ $structure->id }})">Hapus</button>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('modal')
<div class="modal fade" id="structureModal" tabindex="-1" role="dialog" aria-labelledby="structureModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="structureModal">Simpan perubahan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUpdateStructure">
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
        $('#formStructure').submit(function(event){
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
                    window.location.replace(BaseUrl+'/admin/organisasi/koordinator-bidang-kurikulum');
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

    $('input[name=id]').val(id);
    $('input.struck-name').val(name);
    $('input.department').val(department);
    $('input.struck-univ').val(univ);
    $('input.year-start').val(ystart);
    $('input.year-end').val(yend);
    });

    $('#formUpdateStructure').submit(function() {
        event.preventDefault();
        $('#structureModal').modal('hide');

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
                    text: "Struktur berhasil diperbaharui",
                    icon: "success"
                  })
                  .then(() => {
                    window.location.replace(BaseUrl+'/admin/organisasi/koordinator-bidang-kurikulum');
                  });
                }else {
                    swal("", response.responseJSON.message, "warning");
                }
            } 
        });
    });

    function deletePhoto(id){
        swal({
        title: "",
        text: "Hapus photo ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/curriculum-coordinator/'+id,
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
                        window.location.replace(BaseUrl+'/admin/organisasi/koordinator-bidang-kurikulum');
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