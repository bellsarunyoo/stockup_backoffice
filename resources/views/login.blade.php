<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/fontawesome.min.css')}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" media="screen, print" href="js/sweetalert2/sweetalert2.min.css">
    <!-- Styles -->
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>

    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase text-center">StockUp Back Office
                                </h2>
                                <p class="text-white-50 mb-5 text-center">Please enter your login and password!</p>
                                <form action="{{route('login')}}" method="post" class="needs-validation">
                                    @csrf
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" name="username" required class="form-control form-control-lg" />

                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" required class="form-control form-control-lg" />

                                    </div>

                                    <button class="form-control btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="js/sweetalert2/sweetalert2.all.min.js"></script>
</body>

<script>
    $(document).ready(function() {

        var message = "{{ session('success') }}";
        if (message) {
            Swal.fire({
                icon: 'error',
                title: message,
                text: 'กรุณาตรวจสอบ',
                width: '35em',
                backdrop: true,
            })
        }

    })
</script>

</html>