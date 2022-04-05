<header>
    <div class="container">
        <nav id="navigation">
            <a href="/" class="logo">
                <img src="{{ asset('/images/site-logo.png') }}" alt="site-logo">
                <h1>Library DB</h1>
            </a>
            <a aria-label="mobile menu" class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </a>
            <ul class="menu-left">
                <li><a href="/books">Books</a></li>
                <li><a href="/authors">Authors</a></li>
                @if (Route::has('login'))

                    @auth
{{--                        <li><a href="{{ route('logout') }}">Logout</a></li>--}}
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </div>
    <noscript>
        <p>Warning: this page requires Javascript for navigation.</p>
    </noscript>
</header>
<div class="hero-banner">
    <h2>The Lambert Library</h2>
</div>