<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @if(!session('role') && !session('username'))

    <script>
    location.href = "{{route('logout')}}";
    </script>
    @else

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'StockUp BackOffice')</title>

        <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
        <link rel="stylesheet" type="text/css" href="assets/components/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="assets/components/datatables/v1.12.1/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="assets/components/datatables/v1.12.1/buttons.dataTables.min.css">
        <link rel="stylesheet" media="screen, print" href="js/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="js/validationEngine/jquery.validationEngine.min.css" type="text/css" />

        <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
        </style>
        <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>

        </script>

    </head>

    <body>

        <h1 class="text-center">StockUp BackOffice</h1>

        <div class="container-fluid">
            <div class="p-lg-2 col-lg-12">

                <nav class="navbar navbar-expand-lg ">
                    <!-- Container wrapper -->
                    <div class="container-fluid">

                        <!-- Collapsible wrapper -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        </div>
                        <!-- Collapsible wrapper -->

                        <!-- Right elements -->
                        <div class="d-flex align-items-center">

                            <!-- Avatar -->
                            <div class="dropdown">
                                <ul class="dropdown-toggle" id="navbarDropdownMenuAvatar" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('image/logo/img_avatar1.png') }}" class="rounded-circle"
                                        height="25" alt="{{ session('username') }}" loading="lazy" />
                                    {{ session('username') }}
                                </ul>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{route('logout')}}">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <!-- Right elements -->
                    </div>

                </nav>
            </div>

        </div>
        <main>
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        <footer>

        </footer>
        @yield('script')
        <script src="{{asset('js/popper/popper.js')}}"></script>
        <script src="{{asset('assets/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="js/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="js/validationEngine/languages/jquery.validationEngine-th.js"></script>
        <script src="js/validationEngine/jquery.validationEngine.min.js"></script>
        <script src="assets/components/select2/select2.min.js"></script>
        <script src="assets/components/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/components/datatables/dataTables.select.min.js"></script>
        <script src="assets/components/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/components/datatables/v1.12.1/jszip.min.js"></script>
        <script src="assets/components/datatables/buttons.html5.min.js"></script>
        <script src="assets/components/datatables/buttons.print.min.js"></script>
        <script src="assets/components/datatables/buttons.colVis.min.js"></script>
        <script src="assets/components/datatables/dataTables.responsive.min.js"></script>
    </body>



    @endif

</html>