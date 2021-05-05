@extends ('layout')

@section ('content')
    <div class="hero-banner">
        <h2>The Lambert Library</h2>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Authors</h3>
                </div>
                @foreach($authors as $author)
                    <div class="col-4 col-3-md col-2-lg">
                        <a href="#">
                            <img src="https://via.placeholder.com/250x375" alt="Book cover placeholder">
                            <h4>{{ $book->title }}</h4>
                        </a>
                    </div>
                @endforeach
                <div class="col">
                    <a href="{{ route('authors.create') }}" class="button primary">Add an Author</a>
                </div>
            </div>
        </div>
    </main>
@endsection

