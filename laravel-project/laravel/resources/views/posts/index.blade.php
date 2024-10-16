@extends('mylayout')

@section('title', 'Kezdőlap')

@section('content')

<ul>
    @foreach($posts as $post)
        <li>{{ $post -> title }} <i>({{ $post -> user -> name }})</i></li>
    @endforeach
</ul>

@endsection
