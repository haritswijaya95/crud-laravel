<nav>
    <a href="{{ url('/produk') }}">Daftar Produk</a>

    @auth
        <span>Halo, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">Login</a>
    @endguest
</nav>