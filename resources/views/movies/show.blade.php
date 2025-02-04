@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-link-home" href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $movie->title }}</li>
        </ol>
    </nav>
    <div class="container-movie">
        <div class="text-center row">
            <div class="col-md-3">
                <img class="thumbnail-movie" src="{{ $movie->poster }}" alt="">
            </div>
            <div class="col-md-5 text-md-start">
                <h5 class="movie-title">{{ $movie->title }}</h5>
                <span class="year-movie">{{ $movie->release_date->format('d M Y') }}</span>
                <span class="dash">.</span>
                <span class="duration-movie">{{ $movie->formatted_duration }}</span>
                <p class="prolog-movie">
                    {{ $movie->description }}
                </p>
                <div class="badge-category">
                    @foreach ($movie->categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="badge rounded-pill badge-category-movie">{{ $category->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 column-rating">
                <div class="rectangle-rating">
                    <h1 class="rating-movie">Rating</h1>
                    <div class="star">
                        <i class="fa-solid fa-star star-ratings"></i>
                        <span class="average-rating">{{ $movie->average_rating }} / <span class="per">10</span></span>
                    </div>
                    <div class="text-end">
                    </div>
                </div>
                <div class="movie-info-detail">
                    <div class="row">
                        <div class="col">
                            <h6 class="director-movie">Director</h6>
                            <h6 class="director-movie-name">{{ $movie->director }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 col">
                            <div class="movie-info">
                                <h6 class="writters-movie">Writters</h6>
                                <h6 class="writters-movie-name">{{ $movie->writers }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-2 col">
                            <div class="movie-info">
                                <h6 class="writters-movie">Star</h6>
                                <h6 class="star-movie-name">{{ $movie->stars }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 ratio ratio-16x9">
            <iframe src="{{ $streamingUrl }}" title="YouTube video" allowfullscreen></iframe>
        </div>
        <div class="mb-3 badge-frame-video d-flex justify-content-between align-items-center">
            <div class="">
                <span class="badge rounded-pill text badge-frame-video-tools" id="light-toggle" style="cursor: pointer;">
                    <i class="fa-regular fa-lightbulb light-icon"></i>
                    Matikan Lampu
                </span>
                <span class="ml-4 badge rounded-pill text badge-frame-video-tools">
                    <i class="fa-solid fa-film film-icon"></i>
                    Trailer
                </span>
            </div>
            <span class="badge rounded-pill text badge-frame-video-rating">
                <i class="fa-solid fa-star film-icon"></i>
                Berikan Rating
            </span>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightToggle = document.querySelector('#light-toggle');
            const overlay = document.createElement('div');
            overlay.className = 'overlay-dark';
            document.body.appendChild(overlay);

            lightToggle.addEventListener('click', function() {
                overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
                document.querySelector('.container-movie').classList.toggle('movie-focus');
            });

            overlay.addEventListener('click', function() {
                overlay.style.display = 'none';
                document.querySelector('.container-movie').classList.remove('movie-focus');
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .overlay-dark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1050;
            display: none;
        }

        .movie-focus {
            position: relative;
            z-index: 1060;
        }
    </style>
@endpush
