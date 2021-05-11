@extends ('layout')

@section ('content')
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $book->title }}</h3>
                </div>
                <div class="col-4 col-3-md col-2-lg">
                    <a href="">
                        <img src="https://via.placeholder.com/250x375" alt="Book cover placeholder">
                        <h4>{{ $book->title }}</h4>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

