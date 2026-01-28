<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Produk</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav style="display: flex; gap: 15px; padding: 10px; background: #f4f4f4; align-items: center;">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('produk.index') }}">Daftar Produk</a>

            @auth
                <span style="margin-left: auto;">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" style="margin-left: auto;">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endguest
        </nav>
    </header>

    <main style="padding: 20px;">
        @yield('content')
    </main>
</body>
</html>