@extends('layout')

@section('content')
    <main class="no-banner">
        <section id="new-book" class="container">

            <div class="row">
                <header class="col-12">
                    <h2>Add a New Book</h2>
                </header>
                <div class="col">
                    <show-button toggle-event="show-book-search">Search/Scan</show-button>
                </div>
                <div class="col">
                    <button class="button show-toggle" type="button" data-target="create-book" disabled>Create</button>
                </div>
            </div>

            @if ($errors->any())
                <div class="row">
                    <div class="alert alert-danger">
                        <ul>
                            {{dump($errors)}}
                            @foreach ($errors->all() as $key => $error)
                                <li>{{ $key }} : {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="row">
                <book-search-form-component></book-search-form-component>
            </div>


        </section>
    </main>
@endsection
