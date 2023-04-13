<html lang="da">
{{-- <!doctype html> --}}

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('/cute-alert/style.css') }} " />
    
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    @yield('css')
    <style type="text/css">
        .tata-title{color: #fff !important};
    </style>
</head>

<body>
    @yield('content')



    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/assets.startbootstrap.com/js/sb-customizer.js') }}"></script>
    <sb-customizer project="sb-admin-pro"></sb-customizer>
    
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>

    <script src="{{ asset('/toaster/dist/tata.js') }}"></script>


        
    @if (Session::has('flash_message_error'))
        <script>
            tata.error('Fejl...', '{!! session('flash_message_error') !!}', {
              position: 'tr',
              duration: 7000,
              animate: 'slide'
            })
        </script>
    @endif

    @if (Session::has('flash_message_success'))
        <script>
            tata.success('Udført...', '{!! session('flash_message_success') !!}', {
              position: 'tr',
              duration: 7000,
              animate: 'slide'
            })

        </script>
    @endif
    
</body>

</html>
