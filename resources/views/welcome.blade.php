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
        <h2>The Lambert Library</h2>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Recent Additions</h3>
                </div>
                @foreach($recentBooks as $book)
                <div class="col-4 col-3-md col-2-lg">
                    <a href="">
                        <img src="https://placehold.it/250x375" alt="Book cover placeholder">
                        <h4>{{ $book->title }}</h4>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col">
                    <p>Here's a quick list of things that could go on the landing page:</p>
                    <ul>
                        <li><strike>Recently added books</strike></li>
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
            </div>
        </div>
    </main>
@endsection

