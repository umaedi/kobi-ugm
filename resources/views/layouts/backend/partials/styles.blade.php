<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/img/favicon.png">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KOBI | Konsorium Biologi Indonesia</title>
    <link href="{{ asset('backend') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('backend') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="{{ asset('backend') }}/vendor/jquery/jquery.min.js"></script>
    <script>
        function getToken() {
			var name = 'access_tokenku';
		  let matches = document.cookie.match(new RegExp(
			"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		  ));
		  return matches ? decodeURIComponent(matches[1]) : undefined;
		}
             
         $.ajaxSetup({
           headers: {
			Accept: 'application/json',
            Authorization: 'Bearer '+getToken(),
           }
         }); 
         const BaseUrl = "{{ url('/') }}"
    </script>
@stack('css')