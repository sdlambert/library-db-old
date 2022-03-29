@extends('layout')

@section('content')
    <main class="no-banner">
        <section id="new-book" class="container">

            <div class="row">
                <div class="col">
                    <header>
                        <h2>Quick Add</h2>
                    </header>
                    <div class="card">
                        <header>
                            <h4>Scan</h4>
                        </header>
                        <show-button toggle-event="show-book-search">Search/Scan</show-button>
                    </div>
                    <p class="text-center">-OR-</p>
                    <div class="card">
                        <header>
                            <h4>Search</h4>
                        </header>
                        <button class="button show-toggle" type="button" data-target="create-book" disabled>Create</button>
                    </div>
{{--                    <p class="text-center">-OR-</p>--}}
{{--                    <div class="card">--}}
{{--                        <button class="button show-toggle" type="button" data-target="create-book" disabled>Manually Add</button>--}}
{{--                    </div>--}}
                </div>

                <div class="col">

                </div>
                <div class="col-12">
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
