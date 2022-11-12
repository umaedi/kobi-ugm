@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5" id="x-title">Struk Bukti Pembayaran</h3>
        </div>
        <div class="card-body">
            <form id="formSubmit">
                <div class="row" id="data-struk">
                    
                </div>
                <div class="container text-center mt-3">
                    <button type="button" class="btn btn-primary btn-send" id="showMore" onclick="loadMore()" data-value="">Lihat lebih banyak</button>
                    <button class="btn btn-primary"type="button" id="btnSending" style="display: none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Proses...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend') }}/js/sweet_alert.min.js"></script>
    <script>
        let data = {
            page: '1',
        };
        function getContent(data)
        {
            $.ajax({
                url: BaseUrl+'/api/admin/struk',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'get',
                data: data,
                complete: response => {
                    let data = response.responseJSON.data.data;

                    if(data.length > 0) {
                        let html = '';
                        data.forEach(data => {
                            html += `
                            <div class="col-md-4">
                                <label for="">Email pembayaran</label>
                                <input type="text" name="title" class="form-control" value="${data.email}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Waktu pembayaran</label>
                                    <input type="text" name="photo" class="form-control" value="${data.date}">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>{{ __('Struk') }}</label>
                                        <a href="{{ asset('storage/strukpembayaran/') }}/${data.struk}" class="btn btn-sm btn-success form-control my-colorpicker1" target="_blank">lihat</a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Aksi</label>
                                    <button type="button" class="btn btn-primary"onclick="btnDelete(${data.id})">Hapus Struk</button>
                                </div>
                            </div>
                            `
                        });
                        $('#data-struk').append(html);
                        $('#showMore').data('value', response.responseJSON.data.current_page);
                        $('#showMore').removeAttr('style', 'display: none');
                        $('#btnSending').addClass('d-none');
                    }else {
                        $('#btnSending').addClass('d-none');
                        $('#data-struk').html(`
                            <div class="container">
                            <h6 class="text-center">Belum ada struk pembayaran</h6>
                            </div>
                        `);
                    }
                    
                }
            });
        }
        getContent(data);

        //delete foto
        function btnDelete(id){
        swal({
        title: "",
        text: "Hapus struk ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: BaseUrl+'/api/admin/struk/destroy/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'DELETE',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                    swal({
                    title: "",
                    text: "Struk berhasil dihapus",
                    icon: "success"
                    })
                    .then((value) => {
                        window.location.replace(BaseUrl+'/admin/str/bukti-pembayaran');
                    });
                    }else {
                        swal("", response.responseJSON.message, "warning");
                    }
                }
                });
            }
        });  
    }

    function loadMore()
    {
        $('button.btn-send').attr('style', 'display: none');
        $('#btnSending').removeAttr('style', 'display: none');
        var page = parseInt($('#showMore').data('value')) + 1;
        var data = {
        page: page,
    
        }
        getContent(data);
    }
    </script>
@endpush