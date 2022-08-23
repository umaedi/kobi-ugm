<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Media Terbaru</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                aria-labelledby="dropdownMenuLink">
                {{ $dropdown }}
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                {{ $thead }}
            </thead>
            <tbody>
                {{ $tbody }}
            </tbody>
        </table>
    </div>
</div>