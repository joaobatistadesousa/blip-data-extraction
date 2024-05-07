<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="icon" href="https://itechit.com.br/wp-content/uploads/2022/09/cropped-ITECH-IT-LOGO-2-512x512-1-32x32.jpg" sizes="32x32">
    @yield('meta')
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('web.home') }}"><img src="https://itechit.com.br/wp-content/uploads/2023/07/cropped-logo-itech-icone.png" alt="logo" class="logoImage" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-center">
                    @yield('menu-itens')
                </ul>
            </div>
        </div>
    </nav>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p class="text-center">© Itechit. Todos os direitos reservados.</p>

<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
@yield('js')
</body>
</html>
