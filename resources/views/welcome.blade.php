@extends ('layout')

@section ('content')
    <div class="container">
        <router-view :key="$route.fullPath"></router-view>
    </div>
@endsection

