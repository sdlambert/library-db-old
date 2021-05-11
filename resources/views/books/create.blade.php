@extends('layout')

@section('content')
    <main class="no-banner">
        <section id="new-book" class="container">

            <div class="row">
                <header class="col-12">
                    <h2>New Book</h2>
                </header>
                <div class="col">
                    <button class="button" type="button" disabled>Scan a New Book</button>
                </div>
                <div class="col">
                    <show-button toggle-event="show-book-search">Search by ISBN</show-button>
                </div>
                <div class="col">
                    <button class="button show-toggle" type="button" data-target="create-book" disabled>Manual Entry</button>
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
                <book-search-component></book-search-component>
            </div>


        </section>
    </main>
@endsection
