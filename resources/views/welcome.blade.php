@extends ('layout')

@section ('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{ route('books.create') }}" class="button primary">Add a Book</a>
                    <a href="{{ route('authors.create') }}" class="button primary">Add an Author</a>
                </div>
                <div class="col-12">
                    <h3>Recent Additions</h3>
                </div>
                <div class="col-12">
                    <div class="book-grid">
                        @foreach($recentBooks as $book)
                            <div class="book">
                                <a href="{{ route('books.show', $book->id) }}">
                                    <img src="{{ $book->cover }}" alt="The cover image for {{ $book->title }}">
                                    <h4>{{ $book->title }}</h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

