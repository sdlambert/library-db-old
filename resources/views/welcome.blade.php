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
            <div class="row">
                <div class="col">
                    <p>Here's a quick list of things that could go on the landing page:</p>
                    <ul>
                        <li><strike>Recently added books</strike>
                            <ul>
                                <li><strike>Add links to books</strike></li>
                                <li><strike>Get covers working</strike></li>
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
                        <li><strike>AJAX search - books</strike></li>
                        <li><strike>Display results</strike></li>
                        <li>
                            Display error (book not found)
                            <ul>
                                <li>Manual entry (see scratch file!)</li>
                            </ul>
                        </li>
                        <li>Select book from results?</li>
                        <li>Confirm selection</li>
                        <li>Confirm book model</li>
                        <li>Save book details</li>
                        <li>Confirm author model</li>
                        <li>Save author details</li>
                        <li>Confirm publisher model</li>
                        <li>Save publisher details</li>
                        <li>Confirm edition model</li>
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

