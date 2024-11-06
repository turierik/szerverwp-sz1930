@extends('mylayout')

@section('title', 'Kezdőlap')

@section('content')

@if (Session::has('post-created'))
    <div class="p-4 mb-4 bg-green-200 rounded-lg font-bold">A bejegyzés létrehozása sikeres!</div>
@endif

@if (Session::has('post-updated'))
    <div class="p-4 mb-4 bg-green-200 rounded-lg font-bold">A bejegyzés módosítása sikeres!</div>
@endif

@if (Session::has('post-deleted'))
    <div class="p-4 mb-4 bg-green-200 rounded-lg font-bold">A bejegyzés törlése sikeres!</div>
@endif

@can('create', App\Models\Post::class)
    <a class="inline-block mb-4 text-green-500" href="{{ route('posts.create') }}">Új bejegyzés létrehozása</a>
@endcan

<ul>
    @foreach($posts as $post)
        <li><a href="{{ route('posts.show', [ 'post' => $post ]) }}">{{ $post -> title }}</a> <i>({{ $post -> user -> name }})</i></li>
    @endforeach
</ul>

@endsection
