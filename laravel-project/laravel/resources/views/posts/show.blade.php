@extends('mylayout')

@section('title', $post -> title)

@section('content')

<h2>{{ $post -> title }}</h2>

<a href="{{ route('posts.edit', ['post' => $post]) }}">Szerkesztés</a>

<form method="POST" action="{{ route('posts.destroy', [ 'post' => $post ]) }}">
    @csrf
    @method("DELETE")
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Törlés</a>
</form>

<div class="pb-4">
    <b>Szerző:</b> {{ $post -> user -> name }}<br>
    <b>Kategóriák:</b> {{ implode(' ', $post -> categories -> pluck('name') -> toArray()) }}
</div>

{{ $post -> content }}<br>

<a class="inline-block mt-4" href="{{ route('posts.index') }}">Vissza a listához</a>
@endsection
