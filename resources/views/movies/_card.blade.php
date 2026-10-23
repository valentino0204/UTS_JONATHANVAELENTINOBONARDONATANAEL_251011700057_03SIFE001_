<div class="movie-card h-100">
    <div class="poster-wrap">
        @if ($movie->poster_url)
            <img src="{{ $movie->poster_url }}" class="poster-box" alt="{{ $movie->title }}" loading="lazy">
        @else
            <div class="poster-box d-flex align-items-center justify-content-center text-center p-3 text-white-50">
                {{ $movie->title }}
            </div>
        @endif
        <div class="overlay"><span><i class="bi bi-play-circle"></i> Lihat Detail</span></div>
    </div>
    <div class="p-3">
        <h6 class="mb-2 title-clamp">
            <a href="{{ route('movies.show', $movie) }}" class="stretched-link text-white text-decoration-none">
                {{ $movie->title }}
            </a>
        </h6>
        <a href="{{ route('movies.index', ['genre' => $movie->genre]) }}"
           class="genre-badge badge text-bg-danger text-decoration-none">{{ $movie->genre }}</a>
        <div class="small text-secondary mt-2">
            <i class="bi bi-calendar3"></i> {{ $movie->release_years }}
            &bull; <i class="bi bi-clock"></i> {{ $movie->duration }}m
        </div>
    </div>
</div>