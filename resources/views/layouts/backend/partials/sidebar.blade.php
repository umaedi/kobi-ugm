<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
      <div class="sidebar-brand-text">KONSORSIUM BIOLOGI INDONESIA</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="/admin/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Berita/Artikel
    </div>
    <li class="nav-item {{ Request::is('admin/post/create') ? 'active' : '' }}">
    <a class="nav-link" href="/admin/post/create">
        <i class="fas fa-blog"></i>
        <span>Buat Berita</span></a>
  </li>
  <li class="nav-item {{ Request::is('admin/post') ? 'active' : '' }}">
    <a class="nav-link" href="/admin/post">
        <i class="fas fa-fw fa-list"></i>
        <span>Semua Berita</span></a>
  </li>
  <li class="nav-item {{ Request::is('admin/categories') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('categories') }}">
        <i class="fas fa-bookmark"></i>
        <span>Kategori Berita</span></a>
  </li>
  <li class="nav-item {{ Request::is('admin/posts/draft') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.post.draft') }}">
        <i class="fas fa-clipboard-list"></i>
        <span>Draft</span></a>
  </li>
  <hr class="sidebar-divider my-0">
  <li class="nav-item {{ Request::is('admin/event/create') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.event.create') }}">
        <i class="fas fa-blog"></i>
        <span>Buat Berita Kegiatan</span></a>
  </li>
  <li class="nav-item {{ Request::is('admin/kegiatan') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.event') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Semua Kegiatan</span></a>
  </li>
  <li class="nav-item {{ Request::is('admin/event/kategori') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.event.kategori') }}">
        <i class="fas fa-bookmark"></i>
        <span>Kategori Kegiatan</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
      Master Data
  </div>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw  fa-envelope"></i>
        <span>Pengajuan STR</span></a>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/admin/str">Pengajuan STR</a>
            <a class="collapse-item" href="{{ route('strVerif') }}">STR Diterima</a>
            <a class="collapse-item" href="{{ route('strReject') }}">STR Ditolak</a>
        </div>
    </div>
</li>

  <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
        aria-expanded="true" aria-controls="collapseFive">
        <i class="fas fa-fw  fa-users"></i>
        <span>Keanggotaan</span></a>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.users') }}">Anggota Baru</a>
            <a class="collapse-item" href="{{ route('admin.users-active') }}">List Anggota Aktif</a>
            <a class="collapse-item" href="{{ route('admin.users-reject') }}">List Anggota Ditolak</a>
        </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThere"
          aria-expanded="true" aria-controls="collapseThere">
          <i class="fas fw fa-file"></i>
          <span>Dokumen</span>
      </a>
      <div id="collapseThere" class="collapse" aria-labelledby="headingThere" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('admin.publikasi') }}">Publikasi</a>
              <a class="collapse-item" href="{{ route('admin.naskah') }}">Naskah Akademik</a>
              <a class="collapse-item" href="{{ route('admin.ad-art') }}">AD/ART</a>
              <a class="collapse-item" href="{{ route('admin.kurikulum') }}">Kurikulum</a>
              <a class="collapse-item" href="{{ route('admin.laporan') }}">Laporan Kegiatan</a>
          </div>
      </div>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
      Web
  </div>
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenNine"
          aria-expanded="true" aria-controls="collapsenNine">
          <i class="fas fa-sitemap"></i>
          <span>Struktur Organiasi</span>
      </a>
      <div id="collapsenNine" class="collapse" aria-labelledby="headingnNine" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{ route('admin.surat') }}">Surat keputusan</a>
              <a class="collapse-item" href="{{ route('admin.penasihat') }}">Dewan penasihat</a>
              <a class="collapse-item" href="{{ route('admin.ketua') }}">Ketua dan wakil ketua</a>
              <a class="collapse-item" href="{{ route('admin.sekretaris') }}">Sekretaris</a>
              <a class="collapse-item" href="{{ route('admin.bendahara') }}">Bendahara</a>
              <a class="collapse-item" href="{{ route('admin.wilayah') }}">Koordinator wilayah</a>
              <a class="collapse-item" href="{{ route('admin.bid-kurikulum') }}">Bidang Kurikulum</a>
              <a class="collapse-item" href="{{ route('admin.humas') }}">HUMAS</a>
          </div>
      </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
        aria-expanded="true" aria-controls="collapseSix">
        <i class="fas fa-folder"></i>
        <span>Halaman</span>
    </a>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.sejarah') }}">Sejarah</a>
            <a class="collapse-item" href="{{ route('admin.visiMisi') }}">Visi Misi & Tujuan</a>
            <a class="collapse-item" href="{{ route('admin.galeri') }}">Galeri</a>
        </div>
    </div>
</li>
  <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFor"
            aria-expanded="true" aria-controls="collapseFor">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengaturan</h6>
                <a class="collapse-item" href="{{ route('profile') }}">Profil</a>
                {{-- <a class="collapse-item" href="{{ route('settings') }}">Pengaturan Web</a> --}}
            </div>
        </div>
    </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>