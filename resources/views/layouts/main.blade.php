<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    <title>@yield('title')</title>
</head>
<body class="bg-light">
    <div class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('pet.index')}}">AdoptaPet</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav me-auto">
                            <a class="nav-link @yield('active-home')" href="{{route('pet.index')}}">Home</a>
                            <a class="nav-link @yield('active-about')" href="{{route('about')}}">About</a>
                        </div>
                        @if (Auth::check())
                            <div class="navbar-nav">
                                <a class="nav-link me-2 @yield('active-profile')" href="{{route('profile.index')}}">Profile</a>
                                <form method="post" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light">Sign out</button>
                                </form>
                            </div>
                        @else
                            <div class="navbar-nav">
                                <a class="btn btn-outline-light me-2" href="{{route('auth.loginForm')}}">Login</a>
                                <a class="btn btn-warning" href="{{route('registration.index')}}">Sign-up</a>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-fill">
            <div class="container">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mx-1 my-4" role="alert">
                        {{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-1 my-4" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        <footer class="footer py-3 bg-white">
            <div class="container">
                <span class="text-muted">AdoptaPet ©</span>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
</body>
</html>