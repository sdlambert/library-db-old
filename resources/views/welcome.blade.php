@extends ('layout')

@section ('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <!-- TODO integrate into nav when we do auth -->
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif

                    <a href="{{ route('login') }}">Login</a>


                @endauth
            </div>
        @endif
    </div>
    <div class="hero-banner">

    </div>
    <main>
        <div class="container">
            <p>Here's a quick list of things that could go on the landing page:</p>
            <ul>
                <li>Recently added books</li>
                <li>Popular authors</li>
                <li>Popular genres?</li>
                <li>Statistics about the collection
                    <ul>
                        <li>Number of books</li>
                        <li>Number of authors</li>
                        <li>Number of pages</li>
                        <li>% hardcover/trade paperback/paperback</li>
                    </ul>
                </li>
            </ul>
        </div>
    </main>
@endsection

