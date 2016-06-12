<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/libs.css">
  @yield('css')
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
              aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Project Flyer</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <p class="navbar-text pull-right">
        @if($signed)
          Hello, {{ $user->name }}
        @endif
      </p>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="container">
  @yield('content')
</div><!-- /.container -->

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/js/libs.js"></script>

@yield('scripts.footer')

@include('flash')
</body>
</html>

