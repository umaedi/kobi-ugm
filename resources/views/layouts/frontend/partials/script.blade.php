<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
<script src="{{ asset('frontend') }}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('frontend') }}/js/vendor/waypoints.min.js"></script>
{{-- <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script> --}}
<script src="{{ asset('frontend') }}/js/jquery.meanmenu.js"></script>
<script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.fancybox.min.js"></script>
<script src="{{ asset('frontend') }}/js/isotope.pkgd.min.js"></script>
<script src="{{ asset('frontend') }}/js/parallax.min.js"></script>
<script src="{{ asset('frontend') }}/js/backToTop.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('frontend') }}/js/ajax-form.js"></script>
<script src="{{ asset('frontend') }}/js/wow.min.js"></script>
<script src="{{ asset('frontend') }}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{ asset('frontend') }}/js/main.js"></script>
<script>
    function getAdArt()
    {
        $.ajax({
            url: BaseUrl+'/api/user/ad-art',
            complete: (response) => {
                if(response.status == 200) {
                    const data  = response.responseJSON.data.adart;
                    const adArt = data[0];
                    $('nav #adArt').attr('href', '{{ asset('storage/ad-art') }}/' + `${adArt.file_dokumen}`);
                }
            }
        });
    }
    getAdArt();
    
</script>

   <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
    _Hasync.push(['Histats.start', '1,4762535,4,9,110,60,00010000']);
    _Hasync.push(['Histats.fasi', '1']);
    _Hasync.push(['Histats.track_hits', '']);
    (function() {
    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
    hs.src = ('//s10.histats.com/js15_as.js');
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
    })();</script>
    <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4762535&101" alt="web counter" border="0"></a></noscript>
    <!-- Histats.com  END  -->
@stack('js')