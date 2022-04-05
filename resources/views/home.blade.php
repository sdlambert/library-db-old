@extends('layout')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>You are logged in!</p>
                        <p>Redirecting in <span id="seconds">5</span>...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
    <script src="{{asset('/js/redirect.js')}}"></script>
@endpush
@endsection