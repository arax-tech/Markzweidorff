<html lang="da">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link href="{{ asset('backend/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <script src="https://cdn.tiny.cloud/1/iw8vqq3brf1xeb5jeyv7d8egb6gaznj3nbrkud8dfxln1fdq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    @yield('css')

    <!-- Croppie css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <style type="text/css">

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgb(247 88 112 / 30%) !important;
        }
        .dataTable-input:focus {
            box-shadow: 0 0 0 0.25rem rgb(247 88 112 / 30%) !important;
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgb(247 88 112 / 30%) !important;
        }
        .joined:focus-within {
            box-shadow: 0 0 0 0.25rem rgb(247 88 112 / 30%) !important;
        }
        .joined > .form-control {
            box-shadow: none !important;
        }
        .shadow-md{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;
        }
        .tata-title{color: #fff !important};

        .dataTable-table > thead > tr > th {
            font-size: 0.8rem !important;
            font-weight: 600 !important;
        }
        .dataTable-table > tbody > tr > td, .dataTable-table > tbody > tr > th, .dataTable-table > tfoot > tr > td, .dataTable-table > tfoot > tr > th, .dataTable-table > thead > tr > td, .dataTable-table > thead > tr > th{
             font-size: 0.8rem !important;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('/cute-alert/style.css') }} " />
    <style type="text/css">
        /*#preloader{
            background: #fff url({{ asset('loading.gif') }}) no-repeat center center;
            background-size: 10%;
            height: 100vh;
            width: 100%;
            position: fixed;
            z-index: 1040 !important;
        }*/

        #loaderContainer{
            background: #fff !important;
            height: 100vh;
            width: 100%;
            position: fixed;

            z-index: 1040 !important;
        }
        #loader {

            position: absolute;
            width: 300px;
            height: 200px;
            z-index: 15;
            top: 50%;
            left: 50%;


          border: 6px solid #f53b57;
          border-radius: 50%;
          border-top: 6px solid #f3f3f3;
          width: 50px;
          height: 50px;
          -webkit-animation: spin 1.3s linear infinite; /* Safari */
          animation: spin 1.3s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>

    <body class=" @if (auth::user()->sidebar == "Show") nav-fixed @else nav-fixed sidenav-toggled @endif">
        {{-- <div id="preloader"></div> --}}

        <div id="loaderContainer">
            <div id="loader"></div>
        </div> 

   

        
        @include('user.layouts.include.navbar')
        <div id="layoutSidenav">
            @include('user.layouts.include.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('user.layouts.include.footer')
            </div>
        </div>


        {{-- Loading --}}

        {{-- <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading">Login</button> --}}

        <div class="modal fade" id="Loading">
            <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>




    </body>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script>

    <script src="{{ asset('backend/js/scripts.js') }}"></script>

    <script src="{{ asset('backend/js/datatables.latest.js') }}" type="text/javascript"></script>

    


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Croppie js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
    <script type="text/javascript">
         // $('#Load').modal('show');
        const loader = document.getElementById("loaderContainer");
        window.addEventListener("load", function(){
            loader.style.display = "none";
        })
    </script>

    <script type="text/javascript">


        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        var path1 = "{{ url('/document/autocomplete') }}";
        $('input.typeahead.title').typeahead({
            source: function(query, process) {
                return $.get(path1, {
                    title: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>


    <script type="text/javascript">

        $('#sidebarToggle').on('click',function(e){
            let sidebar = $("input[name=sidebar]").val();

            var form_data = new FormData();                  
            form_data.append('sidebar', sidebar);
            form_data.append('_token', "{{csrf_token()}}");
            var uri = "{{ url('toggle_sidebar') }}";
            $.ajax({
                url: uri,
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success:function(response){
                    location.reload();
                },
                error:function(error){
                    alert('Error');
                }

            });

       });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $(".Delete").click(function(){
                var id = $(this).attr('rel');
                var url = $(this).attr('rel1');
                // alert(id);
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                });
                
                $('.swal2-confirm').click(function(){
                    window.location.href = '{{url('')}}'+ '/' + url +'/'+ id;
                });
            });
        });

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#group").chosen({});
            $(".group").chosen({});
            
        });
    </script>

    <script>
        var path2 = "{{ url('/document/autocompleteSubtitle') }}";
        $('input.typeahead.subtitle').typeahead({
            source: function(query, process) {
                return $.get(path2, {
                    subtitle: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
    <script>
        var path3 = "{{ url('/document/autocompleteKeyword') }}";
        $('input.typeahead.keyword').typeahead({
            source: function(query, process) {
                return $.get(path3, {
                    keyword: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

        


    




    <script type="text/javascript">
        $('#custom_form').submit(function(){
            $('button[type=submit]').addClass("disabled");
            $('#icon').addClass("fa fa-spinner");
        });

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{ asset('/toaster/dist/tata.js') }}"></script>


        
    @if (Session::has('flash_message_error'))
        <script>
            tata.error('Opps...', '{!! session('flash_message_error') !!}', {
              position: 'tr',
              duration: 5000,
              animate: 'slide'
            })
        </script>
    @endif

    @if (Session::has('flash_message_success'))
        <script>
            tata.success('Success...', '{!! session('flash_message_success') !!}', {
              position: 'tr',
              duration: 5000,
              animate: 'slide'
            })

        </script>
    @endif

    @yield('js')


    </html>



