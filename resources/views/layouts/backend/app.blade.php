<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="x-csrf-token" content="{{ csrf_token() }}">
  @include('layouts.backend.partials.styles')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.backend.partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.backend.partials.navbar')

                @yield('content')

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ date('Y') }} KOBI.  All Right Reserved. Developed by <a href="https://api.whatsapp.com/send?phone=62895358279544" target="_blank">Last Pictures</a></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar Dari Web ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik logout jika yakin ingin keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger" class="dropdown-item"><i class="bi bi-box-arrow-in-left"></i> Logout</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
    @stack('modal')
    @include('layouts.backend.partials.script')
</body>

</html>