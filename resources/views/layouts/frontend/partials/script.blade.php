<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
<script src="{{ asset('frontend') }}/js/vendor/jquery-3.5.1.min.js"></script>
<script src="{{ asset('frontend') }}/js/vendor/waypoints.min.js"></script>
<script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script>
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
   function getCategories()
    {
        $.ajax({
            url: BaseUrl+'/api/user/event/categories',
            method: 'GET',
            processData: false,
            contentType: false,
            cache: false,
            complete: (response) => {
                if(response.status == 200) {
                    let data = response.responseJSON.data.evcat;
                    let append = '';
                    $.each(data, (k,v) => {
                        append +='<li><a href=/event/'+ v.slug +'>'+ v.name +'</a></li>'
                    });
                    $('#categories').html(append);
                    getAdArt();
                }else {
                    console.log('gagal');
                }
            }
        });

        function getAdArt()
        {
            $.ajax({
                url: BaseUrl+'/api/user/ad-art',
                method: 'GET',
                processData: false,
                contentType: false,
                cache: false,
                complete: (response) => {
                    if(response.status == 200) {
                        const data  = response.responseJSON.data.adart;
                        const adArt = data[0];
                        $('nav #adArt').attr('href', '{{ asset('storage/dokumen') }}/' + `${adArt.file_dokumen}`);
                    }
                }
            });
        }

    }
    getCategories();
    
</script>
@stack('js')