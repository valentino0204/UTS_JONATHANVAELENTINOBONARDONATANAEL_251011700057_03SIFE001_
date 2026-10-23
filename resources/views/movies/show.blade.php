@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('movies.index') }}">Daftar Film</a></li>
        <li class="breadcrumb-item active">{{ $movie->title }}</li>
    </ol>
</nav>

<div class="hero shadow" style="--bg:url('{{ $movie->poster_url }}')">
    <div class="row g-0">
        <div class="col-md-4 col-lg-3 p-4">
            @if ($movie->poster_url)
                <img src="{{ $movie->poster_url }}" class="poster-box" alt="{{ $movie->title }}">
            @else
                <div class="poster-box d-flex align-items-center justify-content-center text-center p-3">
                    {{ $movie->title }}
                </div>
            @endif
        </div>
        <div class="col-md-8 col-lg-9 p-4 p-lg-5">
            <h1 class="display-6 fw-bold">{{ $movie->title }}</h1>

            <div class="d-flex flex-wrap gap-2 my-3">
                <a href="{{ route('movies.index', ['genre' => $movie->genre]) }}"
                   class="meta-pill text-decoration-none text-white"><i class="bi bi-tag"></i> {{ $movie->genre }}</a>
                <span class="meta-pill"><i class="bi bi-calendar3"></i> {{ $movie->release_years }}</span>
                <span class="meta-pill">
                    <i class="bi bi-clock"></i> {{ $movie->duration }} menit
                    ({{ intdiv($movie->duration, 60) }}j {{ $movie->duration % 60 }}m)
                </span>
            </div>

            <h5 class="mt-4">Sinopsis</h5>
            <p class="text-white-50 lh-lg">{{ $movie->description }}</p>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('movies.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@if ($related->isNotEmpty())
    <h2 class="h4 mt-5 mb-3">Film {{ $movie->genre }} lainnya</h2>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach ($related as $item)
            <div class="col">
                @include('movies._card', ['movie' => $item])
            </div>
        @endforeach
    </div>
@endif
@endsection