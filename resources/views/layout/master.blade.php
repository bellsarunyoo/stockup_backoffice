<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    @if (!session("role") && !session("username"))
        <script>
            location.href = "{{ route("logout") }}";
        </script>
    @else

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>@yield("title", "StockUp BackOffice")</title>
            {{-- Logo  Icon --}}
            <link type="image/x-icon" href="{{ asset("image/logo/stockup.jpg") }}" rel="icon">
            {{-- Logo Logo --}}
            <link href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("assets/fontawesome/css/fontawesome.min.css") }}" rel="stylesheet">
            <link href="{{ asset("assets/toastr/toastr.min.css") }}" rel="stylesheet">
            <link type="text/css" href="assets/components/select2/select2.min.css" rel="stylesheet">
            <link type="text/css" href="assets/components/datatables/v1.12.1/jquery.dataTables.min.css"
                rel="stylesheet">
            <link type="text/css" href="assets/components/datatables/v1.12.1/buttons.dataTables.min.css"
                rel="stylesheet">
            <link href="js/sweetalert2/sweetalert2.min.css" rel="stylesheet" media="screen, print">
            <link type="text/css" href="js/validationEngine/jquery.validationEngine.min.css" rel="stylesheet" />

            <style>
                body {
                    font-family: 'Kanit', sans-serif;
                }
            </style>
            <script src="{{ asset("js/jquery-3.7.1.min.js") }}"></script>

        </head>

        <body>

            <h1 class="text-center">StockUp BackOffice</h1>

            <div class="container-fluid">
                <div class="p-lg-2 col-lg-12">

                    <nav class="navbar navbar-expand-lg">
                        <!-- Container wrapper -->
                        <div class="container-fluid">

                            <!-- Collapsible wrapper -->
                            <div class="navbar-collapse collapse" id="navbarSupportedContent">

                            </div>
                            <!-- Collapsible wrapper -->

                            <!-- Right elements -->
                            <div class="d-flex align-items-center">

                                <!-- Avatar -->
                                <div class="dropdown">
                                    <ul class="dropdown-toggle" id="navbarDropdownMenuAvatar" data-bs-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <img class="rounded-circle" src="{{ asset("image/logo/img_avatar1.png") }}"
                                            alt="{{ session("username") }}" height="25" loading="lazy" />
                                        {{ session("username") }}
                                    </ul>

                                    <ul class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="navbarDropdownMenuAvatar">
                                        <li>
                                            <a class="dropdown-item text-danger"
                                                href="{{ route("logout") }}">Logout</a>
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
                    @yield("content")
                </div>
            </main>

            <footer>

            </footer>
            @yield("script")
            <script src="{{ asset("js/popper/popper.js") }}"></script>
            <script src="{{ asset("assets/toastr/toastr.min.js") }}"></script>
            <script src="{{ asset("assets/bootstrap/js/bootstrap.js") }}"></script>
            <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
            <script src="{{ asset("assets/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
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
