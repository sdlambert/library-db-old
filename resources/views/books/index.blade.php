@extends ('layout')

@section ('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>All Books</h3>
                </div>
                @foreach($books as $book)
                    <div class="book">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img src="{{ $book->cover }}" alt="The cover image for {{ $book->title }}">
                            <h4>{{ $book->title }}</h4>
                        </a>
                    </div>
                @endforeach
                <p>TODO: Add pagination here</p>
            </div>
        </div>
    </main>
@endsection

