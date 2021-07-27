<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Research Brisk </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap4.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('/css/fontawesome4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common/css/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('common/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/master.css') }}">
    <style>
        body{
            background: #f1f1f1;
        }
        .card-body{
            background: #efefefde !important;
        }
    </style>

</head>
<body class="antialiased">

<div id="root">
    <nav class="navbar navbar-expand-lg navbar-light primary-color-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">ResearchBrisk</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 60vh;">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('welcome') }}">Home 
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown"  aria-expanded="false">Academic</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="{{ route('academicbio')  }}">Academic Bio</a></li>
                            <li><a class="dropdown-item" href="{{ route('academicpayrates')  }}">Pay Rates</a></li>
                            <li><a class="dropdown-item" href="{{ route('academicservices')  }}">Services</a></li>
                            <li><a class="dropdown-item" href="{{ route('academicsamples')  }}">Work Samples</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/orderassignment">Order An Assignment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('posts') }}">Posts </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jobs') }}">Jobs</a></li>
                    @auth
                        <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link text-sm text-gray-700 underline">Dashboard</a></li>
                    @else
                        @if (Route::has('login'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="mt-3 pt-2">
        <div class="">

            @yield('content')

        </div>
    </div>

    <article class="footer p-5 primary-color-dark shadow-md">
        <footer>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <h5>ResearchBrisk</h5>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5 class="underline">Solutions</h5>
                    <hr>
                    <ul class="list-group mt-4 list-white">
                        <li><a href="{{ route('academicbio')  }}">Academic</a></li>
                        <li> <a href="{{ route('posts') }}">Posts</a> </li>
                        <li> <a href="/post_view/56/Office Assistants Needed. Hurry and Apply">Podcasts</a> </li>
                        <li><a href="{{ route('jobs') }}">Jobs</a></li>
                        <li><a href="/post_view/56/Office Assistants Needed. Hurry and Apply">Adverts</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5 class="underline">Company</h5>
                    <hr>
                    <ul class="list-group mt-4 list-white">
                        <li> <a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('academicservices')  }}">Services</a></li>
                        <li><a href="{{ route('academicsamples')  }}">Work Samples</a></li>
                        <li><a href="{{ route('academicpayrates')  }}">Pay Rates</a></li>
                        <li><a href="/academictestimonials">Testimonials</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5 class="underline">Connect</h5>
                    <hr>
                    <ul class="list-group mt-4 list-white">
                        <li> <i class="fa fa-facebook-official f_icon" aria-hidden="true"></i> Facebook </li>
                        <li> <i class="fa fa-instagram f_icon" aria-hidden="true"></i> Instagram </li>
                        <li> <i class="fa fa-twitter-square f_icon" aria-hidden="true"></i> Twitter </li>
                        <li> <i class="fa fa-linkedin-square f_icon" aria-hidden="true"></i> Linked In </li>
                    </ul>
                </div>
            </div>
        </footer>
    </article>
</div>




<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src="{{ asset('/js/bootstrap4.min.js') }}" ></script>
<script src="{{ asset('common/js/toastr.min.js') }}"></script>
<script src="{{ asset('common/js/select2.min.js') }}"></script>

@yield('scripts')

<!-- notifications -->
<script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif


    $(document).ready(function() {
        $('.select2').select2({
            theme:"bootstrap",
            allowClear: true
        });
    });
</script>

</body>
</html>
