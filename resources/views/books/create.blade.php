@extends('layout')

@section('content')
    <main class="no-banner">
        <section id="new-book" class="container">

            <div class="row">
                <div class="col">
                    <header>
                        <h2>Quick Add</h2>
                    </header>
                    <card id="scan-card">
                        <template v-slot:header>
                            <h4 class="text-center">Scan</h4>
                        </template>
                        <isbn-scanner></isbn-scanner>
                    </card>
                    <p class="text-center">-OR-</p>

                    <card id="search-card">
                        <template v-slot:header>
                            <h4 class="text-center">Search</h4>
                        </template>
                        <isbn-search></isbn-search>
                    </card>
                </div>
            </div>
        </section>
        <modal id="book-thumbnail-modal" v-cloak>
            <template v-slot:header>
                <h4>Search Results</h4>
            </template>

            <confirm-book-thumbnail></confirm-book-thumbnail>

            <template v-slot:footer>
                <confirm-book-buttons></confirm-book-buttons>
            </template>
        </modal>
    </main>
@endsection
