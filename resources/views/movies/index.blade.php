@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')

@if ($latest->isNotEmpty())
    <div id="latestSlider" class="carousel slide mb-5 rounded-4 overflow-hidden shadow"
         data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">

        @if ($latest->count() > 1)
            <div class="carousel-indicators">
                @foreach ($latest as $i => $item)
                    <button type="button" data-bs-target="#latestSlider" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
                @endforeach
            </div>
        @endif

        <div class="carousel-inner">
            @foreach ($latest as $i => $item)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <div class="hero hero-slide" style="--bg:url('{{ $item->poster_url }}')">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3 d-none d-md-block p-4">
                                @if ($item->poster_url)
                                    <img src="{{ $item->poster_url }}" class="poster-box" alt="{{ $item->title }}">
                                @else
                                    <div class="poster-box d-flex align-items-center justify-content-center text-center p-3">
                                        {{ $item->title }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9 p-4 p-lg-5">
                                <span class="badge text-bg-warning mb-3">
                                    <i class="bi bi-star-fill"></i> Film Terbaru
                                </span>
                                <h1 class="display-5 fw-bold">{{ $item->title }}</h1>
                                <div class="d-flex flex-wrap gap-2 my-3">
                                    <span class="meta-pill"><i class="bi bi-tag"></i> {{ $item->genre }}</span>
                                    <span class="meta-pill"><i class="bi bi-calendar3"></i> {{ $item->release_years }}</span>
                                    <span class="meta-pill"><i class="bi bi-clock"></i> {{ $item->duration }} menit</span>
                                </div>
                                <p class="mb-4 text-white-50">{{ Str::limit($item->description, 200) }}</p>
                                <a href="{{ route('movies.show', $item) }}" class="btn btn-accent btn-lg">
                                    <i class="bi bi-play-fill"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($latest->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#latestSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#latestSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        @endif
    </div>
@endif

{{-- Chip genre --}}
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('movies.index', request()->except('page', 'genre')) }}"
       class="chip {{ request('genre') ? '' : 'active' }}">Semua</a>
    @foreach ($genres as $g)
        <a href="{{ route('movies.index', array_merge(request()->except('page'), ['genre' => $g])) }}"
           class="chip {{ request('genre') === $g ? 'active' : '' }}">{{ $g }}</a>
    @endforeach
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="h4 mb-0">Daftar Film</h2>
        <small class="text-secondary">
            {{ $movies->total() }} film ditemukan
            @if (request('q')) untuk "<strong>{{ request('q') }}</strong>" @endif
        </small>
    </div>

    <form method="GET" action="{{ route('movies.index') }}" class="d-flex flex-wrap gap-2">
        <input type="hidden" name="q" value="{{ request('q') }}">
        <input type="hidden" name="genre" value="{{ request('genre') }}">

        <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
            <option value="judul"   @selected($sort === 'judul')>Judul (A-Z)</option>
            <option value="tahun"   @selected($sort === 'tahun')>Tahun rilis</option>
            <option value="durasi"  @selected($sort === 'durasi')>Durasi terpanjang</option>
        </select>

        @if (request()->hasAny(['q', 'genre', 'sort']))
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </form>
</div>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse ($movies as $movie)
        <div class="col">
            @include('movies._card', ['movie' => $movie])
        </div>
    @empty
        <div class="col-12 text-center py-5 text-secondary">
            <i class="bi bi-camera-reels display-3"></i>
            <p class="mt-3">Film tidak ditemukan.</p>
            <a href="{{ route('movies.index') }}" class="btn btn-outline-light btn-sm">Lihat semua film</a>
        </div>
    @endforelse
</div>

<div class="mt-5 d-flex justify-content-center">
    {{ $movies->links() }}
</div>
@endsection