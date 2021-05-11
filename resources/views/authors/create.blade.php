@extends ('layout')

@section ('content')
    <div class="hero-banner">
        <h2>The Lambert Library</h2>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Add an Author</h3>
                    <form action="POST" action="/authors" id="create-author">
                        @csrf
                        <fieldset id="author-fields">
                            <legend>Author</legend>
                            <div class="row">
                                <div class="form-group col-6 col-4-lg">
                                    <label for="first_name">First Name</label>
                                    <input @error('first_name') class="error" @enderror type="text" name="first_name" id="first_name" required>
                                    @error('first_name')
                                    <p class="text-error">{{ $errors->first('first_name') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-6 col-4-lg">
                                    <label for="last_name">Last Name</label>
                                    <input @error('last_name') class="error" @enderror type="text" name="last_name" id="last_name" required>
                                    @error('last_name')
                                    <p class="text-error">{{ $errors->first('last_name') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-4-lg">
                                    <label for="pseudonym">Pseudonym</label>
                                    <input type="text" name="pseudonym" id="pseudonym">
                                </div>
                                <div class="form-group col-6">
                                    <label for="birth_date">Birth Date</label>
                                    <input @error('birth_date') class="error" @enderror type="date" name="birth_date" id="birth_date">
                                    @error('birth_date')
                                    <p class="text-error">{{ $errors->first('birth_date') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="death_date">Death Date</label>
                                    <input @error('birth_date') class="error" @enderror type="date" name="death_date" id="death_date">
                                    @error('death_date')
                                    <p class="text-error">{{ $errors->first('death_date') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-12 text-right">
                            <button class="button" type="reset">Reset</button>
                            <button class="button" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

