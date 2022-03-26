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
                    <book-grid :books="{{ $recentBooks }}"></book-grid>
                </div>
            </div>
        </div>
    </main>
@endsection

