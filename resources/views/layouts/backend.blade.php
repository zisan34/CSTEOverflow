<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    <!-- Custom styles for this template -->
    <link href="{{asset('front/css/clean-blog.css')}}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('front/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
    @yield('links')


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container text-center" {{-- style="padding: 5px 0px;" --}} >
      <a class="navbar-brand" href="{{ URL('/') }}"><h4>{{ env('APP_NAME', 'Laravel') }}</h4></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL('/') }}">Home</a>
            </li>
            @if(Auth::user()->admin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Admin Panel</a>
            </li>

            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('onlineExam') }}">Online Exam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Notice</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Posts</a>
            </li>


                        <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                       {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

            
              
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead" style="background-image: url('{{asset('front/img/home-bg.jpg')}}'); max-height: 67px;">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            
          </div>
        </div>
      </div>
    </div>
  </header>

<div class="container">

  <div class="row">
    <div class="col-md-3">
      <ul class="list-group">

        <li class="list-group-item">
        <a href="{{ route('home') }}">Home</a></li>

        <li class="list-group-item">
        <a href="{{ route('courses') }}">Courses</a></li>

        <li class="list-group-item">
        <a href="{{ route('tags') }}">Tags</a></li>

        <li class="list-group-item">
        <a href="">All Posts</a></li>       



        {{-- <li class="list-group-item">
        <a href="{{ route('category.create') }}">Create new category</a></li> --}}

        <li class="list-group-item">
        <a href="">All Trashed Posts</a></li>

        <li class="list-group-item">
        <a href="">My Profile</a></li>

        <li class="list-group-item">
        <a href="{{ route('users') }}">Users</a></li>

        <li class="list-group-item">
        <a href="">Create new User</a></li>
        <li class="list-group-item">
        <a href="">Site Settings</a></li>

      </ul>
    </div>
    
    <div class="col-md-9">
            @yield('content')
    </div>
  </div>

</div>





  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('front/js/clean-blog.min.js')}}"></script>

  @yield('scripts')

</body>

</html>




