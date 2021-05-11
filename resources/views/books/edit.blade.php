@extends('layout')

@section('content')
    <main class="no-banner">
        <section id="new-book" class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Edit Book</h2>
                </div>
            </div>
            <form method="POST" action="/books" id="create-book" class="is-hidden">
                @csrf
                @method('PUT')
                <fieldset>
                    <legend>Book Details</legend>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="The Grapes of Wrath" value="{{$book->title}}">
                        </div>
                        <div class="form-group col-12">
                            <label for="blurb">Blurb</label>
                            <textarea name="blurb" id="blurb" cols="30" rows="4" placeholder="A short description of the book" value="{{$book->blurb}}"></textarea>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Edition</legend>
                    <div class="row">
                        <div class="form-group col-6 col-3-lg">
                            <label for="isbn13">ISBN 13</label>
                            <input type="text" name="isbn13" id="isbn13" placeholder="XXX-X-XX-XXXXXX-X" value="{{$edition->isbn13}}">
                        </div>
                        <div class="form-group col-6 col-3-lg">
                            <label for="isbn10">ISBN 10</label>
                            <input type="text" name="isbn10" id="isbn10" placeholder="XXXXXXXXX-X" value="{{$edition->isbn10}}">
                        </div>
                        <div class="form-group col-12 col-6-lg">
                            <label for="publisher">Publisher</label>
                            <!-- todo convert to datalist -->
                            <input type="text" name="publisher" id="publisher" placeholder="Random House value="{{$edition->publisher}}">
                        </div>
                        <div class="form-group col-6 col-3-md">
                            <label for="month">Month Published </label>
                            <!-- todo extract month from publish_date -->
                            <select name="month" id="month" value="">
                                <option value="">Select a month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="form-group col-6 col-3-md">
                            <label for="year">Year Published </label>
                            <!-- todo extract year from publish_date -->
                            <input type="number" name="year" id="year" placeholder="1999" value="">
                        </div>
                        <div class="form-group col-6 col-3-md">
                            <label for="pages">Pages</label>
                            <input type="number" name="pages" id="pages" placeholder="279" value="{{$edition->pages}}">
                        </div>
                        <div class="form-group col-6 col-3-md">
                            <label for="format">Format</label>
                            <select name="format" id="format" value="{{$edition->format}}">
                                <option value="">Select a format</option>
                                <option value="0">Hardcover</option>
                                <option value="1">Trade Paperback</option>
                                <option value="2">Paperback</option>
                                <option value="3">Book Club Edition</option>
                            </select>
                        </div>
                        <div class="form-group col-3-md">
                            <label for="goodreads">Goodreads ID</label>
                            <input type="text" name="goodreads" id="goodreads" value="{{$edition->goodreads}}">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Author</legend>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="author-search">Author Search</label>
                            <input type="text" name="author-search" id="author-search">
                        </div>
                        <div class="col-12">
                            <button type="button" class="button show-toggle" data-target="new-author">Add New Author</button>
                        </div>
                    </div>
                    <!-- todo refactor author search to allow the user to clear the author and search or add a new one-->
                    <!-- fields will be disabled/read-only until the user clicks edit author
                         then the user will be prompted to search for an existing author or add a new one
                    -->
                    <div id="author">
                        <div class="row">
                            <div class="form-group col-6 col-4-lg">
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name" id="first-name">
                            </div>
                            <div class="form-group col-6 col-4-lg">
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last-name" id="last-name">
                            </div>
                            <div class="form-group col-12 col-4-lg">
                                <label for="pseudonym">Pseudonym</label>
                                <input type="text" name="pseudonym" id="pseudonym">
                            </div>
                            <div class="form-group col-6">
                                <label for="birth-date">Birth Date</label>
                                <input type="date" name="birth-date" id="birth-date">
                            </div>
                            <div class="form-group col-6">
                                <label for="death-date">Death Date</label>
                                <input type="date" name="death-date" id="death-date">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <!-- todo allow multiple authors on edit form -->
                <div class="row">
                    <div class="col-12 text-right">
                        <button class="button" type="reset">Reset</button>
                        <button class="button" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection