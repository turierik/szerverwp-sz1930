@extends('mylayout')

@section('title', 'Új bejegyzés')

@section('content')

<h2>Új bejegyzés</h2>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf

    Cím:<br>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title')
        <span class="text-red-500 font-bold">{{ $message }}</span>
    @enderror<br>

    Tartalom:<br>
    <textarea name="content">{{ old('content') }}</textarea>
    @error('content')
        <span class="text-red-500 font-bold">{{ $message }}</span>
    @enderror<br>

    Szerző:<br>
    <select name="author_id">
        @foreach ($users as $user)
            <option value="{{ $user -> id}}" {{ $user -> id == old('author_id') ? 'selected' : ''  }}>{{ $user -> name }}</option>
        @endforeach
    </select>
    @error('author_id')
        <span class="text-red-500 font-bold">{{ $message }}</span>
    @enderror<br>

    Kategóriák:<br>
    @foreach($categories as $c)
        <input type="checkbox" name="categories[]" value="{{ $c -> id }}"
        {{ in_array($c -> id, old('categories', [])) ? 'checked' : ''  }}> {{ $c -> name }} <br>
    @endforeach
    @error('categories')
        <span class="text-red-500 font-bold">{{ $message }}</span>
    @enderror

    <button type="submit">Küldés</button>

</form>

@endsection
