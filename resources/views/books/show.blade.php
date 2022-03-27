@extends ('layout')

@section ('content')
    <main id="show-book">
        <section class="container">
            <div class="row">
                <book-detail :book="{{ json_encode($book) }}"></book-detail>
            </div>
        </section>
    </main>
@endsection

