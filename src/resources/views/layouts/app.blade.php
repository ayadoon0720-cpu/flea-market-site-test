<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Product List', 'もぎたて')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="logo">mogitate</h1>
        </div>
    </header>
<main class="main">
    <div class="main-inner">
    @yield('content')
    </div>
</main>

</body>
</html>