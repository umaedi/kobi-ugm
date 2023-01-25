<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col-sm-12">
            <div class="d-sm-flex align-items-center justify-content-between">
                {{ $header }}
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
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    {{ $thead }}
                </thead>
                <tbody class="text-uppercase">
                    {{ $tbody }}
                </tbody>
            </table>
        </div>
    </div>
</div>