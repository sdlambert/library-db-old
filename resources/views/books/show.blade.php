@extends ('layout')

@section ('content')
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $book->title }}</h3>
                </div>
                <div class="col-12">
                    <img src="{{ $book->cover }}" alt="The cover image for {{ $book->title }}">
                </div>
            </div>
        </section>
    </main>
@endsection

