<div class="sidebar__area">
    <div class="sidebar__wrapper">
       <div class="sidebar__close">
          <button class="sidebar__close-btn" id="sidebar__close-btn">
          <span><i class="fal fa-times"></i></span>
          <span>Tutup</span>
          </button>
       </div>
       <div class="sidebar__content">
          <div class="mobile-menu mobile-menu-5"></div>
          <div class="sidebar__info mt-50">
             <a href="{{ route('pendaftaran') }}" class="w-btn w-btn-11 w-btn-13 d-block mb-15 mt-15">Anggota</a>
             <a href="{{ route('str') }}" class="w-btn w-btn-11 d-block">STR</a>
          </div>
       </div>
    </div>
 </div>
 <div class="body-overlay"></div>
 <div class="search-wrapper p-relative transition-3">
    <div class="search-form transition-3">
       <form action="#">
          <input type="text" placeholder="Enter Your Keyword">
          <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
       </form>
       <a href="javascript:void(0);" class="search-close"><i class="far fa-times"></i></a>
    </div>
 </div>