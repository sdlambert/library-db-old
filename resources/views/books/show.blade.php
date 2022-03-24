@extends ('layout')

@section ('content')
    <main id="show-book">
        <section class="container">
            <div class="row">
                <div class="col-12 col-4-md text-center">
                    <h3>{{ $book->title }}</h3>
                    <img src="{{ $book->cover }}" alt="The cover image for {{ $book->title }}">
                </div>
                <div class="col-12 col-8-md">
                    <div class="row">
                        <div class="col-12">
                            <div class="links">
                                <div><strong>Links</strong></div>
                                <div class="icon-links">
                                    @isset($editions[0]->goodreads)
                                        <a href="https://www.goodreads.com/book/show/{{ $editions[0]->goodreads }}" class="icon" target="_blank">
                                            <img src="{{ asset('/images/icons/goodreads_sm.png') }}" alt="Goodreads icon">
                                        </a>
                                    @endisset
                                    @isset($editions[0]->openlibrary)
                                        <a href="https://openlibrary.org/books/{{ $editions[0]->openlibrary }}" class="icon icon-shadow" target="_blank">
                                            <img src="{{ asset('/images/icons/open-library-logo.png') }}" alt="Open Libary icon">
                                        </a>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        <div class="col col-6-md">
                            @if(count($authors) > 1)
                                <h3>Authors</h3>
                            @else
                                <h3>Author</h3>
                            @endif
                            @foreach($authors as $author)
                                <dl>
                                    <div>
                                        <dt>Name</dt>
                                        <dd>{{ $author->last_name }}, {{ $author->first_name }}</dd>
                                    </div>
                                    @isset($author->pseudonym)
                                        <div>
                                            <dt>Pseudonym(s):</dt>
                                            <dd>{{ $author->pseudonym }}</dd>
                                        </div>
                                    @endisset
                                    @isset($author->birth_date)
                                        <div>
                                            <dt>Date of birth</dt>
                                            <dd>{{ $author->birth_date }}</dd>
                                        </div>
                                    @endisset
                                    @isset($author->death_date)
                                        <div>
                                            <dt>Date of death</dt>
                                            <dd>{{ $author->death_date }}</dd>
                                        </div>
                                    @endisset
                                </dl>
                                <hr>
                            @endforeach
                        </div>
                        <div class="col col-6-md">
                            @if(count($editions) > 1)
                                <h3>Editions</h3>
                            @else
                                <h3>Edition</h3>
                            @endif
                            @foreach($editions as $edition)
                                @if($loop->index > 1)
                                    <hr>
                                @endif
                                <dl>
                                    @isset($edition->format)
                                        <div>
                                            <dt>Format</dt>
                                            <dd>{{ \App\Enums\EditionFormat::getDescription((int)$edition->format) }}</dd>
                                        </div>
                                    @endisset
                                    @isset($edition->isbn10)
                                        <div>
                                            <dt>ISBN10</dt>
                                            <dd>{{ $edition->isbn10 }}</dd>
                                        </div>
                                    @endisset
                                    @isset($edition->isbn13)
                                        <div>
                                            <dt>ISBN13</dt>
                                            <dd>{{ $edition->isbn13 }}</dd>
                                        </div>
                                    @endisset
                                    @isset($edition->isbn13)
                                        <div>
                                            <dt>Published</dt>
                                            <dd>{{ $edition->publish_date }}</dd>
                                        </div>
                                    @endisset
                                    @isset($edition->isbn13)
                                        <div>
                                            <dt>Pages</dt>
                                            <dd>{{ $edition->pages }}</dd>
                                        </div>
                                    @endisset
                                    @isset($publishers[$loop->index]->name)
                                        <div>
                                            <dt>Publisher</dt>
                                            <dd>{{ $publishers[$loop->index]->name }}</dd>
                                        </div>
                                    @endisset
                                </dl>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

