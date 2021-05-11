@extends ('layout')

@section ('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Recent Additions</h3>
                </div>
                @foreach($recentBooks as $book)
                <div class="col-4 col-3-md col-2-lg">
                    <a href="">
                        <img src="https://via.placeholder.com/250x375" alt="Book cover placeholder">
                        <h4>{{ $book->title }}</h4>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('books.create') }}" class="button primary">Add a Book</a>
                    <a href="{{ route('authors.create') }}" class="button primary">Add an Author</a>
                    <p>Here's a quick list of things that could go on the landing page:</p>
                    <ul>
                        <li><strike>Recently added books</strike>
                            <ul>
                                <li>Add links to books</li>
                                <li>Get covers working</li>
                            </ul>
                        </li>
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
                    <p>Todo:</p>
                    <ul>
                        <li>Revisit need to edit any individual resources, all of them come from API</li>
                        <li>Focus instead on consuming API and saving data</li>
                        <li>AJAX search - books</li>
                        <li>Display results</li>
                        <li>Select book from results?</li>
                        <li>Confirm selection</li>
                        <li>Save book</li>
                        <li>Save authors</li>
                        <li>Save publisher</li>
                        <li>Save edition</li>
                        <li>AJAX search - authors</li>
                        <li>AJAX search - publishers</li>
                        <li>AJAX search - editions</li>
                        <li>AJAX search - covers?</li>
                        <li>Save multiple models for book.create</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection

