<!doctype html>
<html class="no-js" lang="zxx">
   
<head>
      @include('layouts.frontend.partials.styles')
     <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body>
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <header>
         @include('layouts.frontend.partials.navbar')
      </header>
      @include('layouts.frontend.partials.sidebar')
      <div class="body-overlay"></div>
      <main>
         @yield('content')
      </main>

      @include('layouts.frontend.partials.footer')

      @include('layouts.frontend.partials.script')
   </body>

</html>

