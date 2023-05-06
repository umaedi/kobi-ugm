@extends('layouts.backend.app')
@section('content')
<div class="container-fluid">
    <div class="add-category card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5" id="x-title">Statistik Pengunjung</h3>
        </div>
        <div class="card-body">
            <form id="formSubmit">
                <div class="row">
                    <div class="col-md-8">
                        <label for="">Tampilkan berdasarkan bulan</label>
                        <select class="form-control" id="per_bulan">
                            <option value="">--Pilih Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="12">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="total_pengunjung">total Pengunjung</label>
                        <input type="text" class="form-control" disabled id="total_pengunjung" value="0">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Pengunjung Berdasarkan Waktu</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Hari ini</th>
                        <th scope="col">Kemarin</th>
                        <th scope="col">Bulan ini</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>{{ $hari_ini }}</th>
                        <td>{{ $kemaren }}</td>
                        <td>{{ $bulan_ini }}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="h5 mb-0 text-gray-800 d-inline mr-5">Paling sering dilihat</h3>
        </div>
        <div class="card-body">
            @include('components._loading')
            <div class="table-responsive" id="x-data-table">
                
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script type="text/javascript">
        var bulan = "";
        $(document).ready(function() {
            loadData();
            getVisitor();

            $('#per_bulan').change(function() {
                fiterVisitor();
            });
        });

        async function loadData() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                }
            }
            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#x-data-table').html(result)

            }).catch((err) => {
              loading(false);
              console.log('error');
            });
        }

        function loading(state) {
            if(state) {
                $('#x-loading').removeClass('d-none');
            }else {
                $('#x-loading').addClass('d-none');
            }
        }


        function  fiterVisitor() {
             bulan = $('#per_bulan').val();
            getVisitor()
        }

        function getVisitor()
        {

            $.ajax({
                url: '/api/admin/visitor',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'GET',
                data: {bulan: bulan},
                complete: (response) => {
                    $('#total_pengunjung').val(response.responseJSON.data);
                }
            });
        }
    </script>
@endpush