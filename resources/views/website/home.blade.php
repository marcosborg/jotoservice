@extends('layouts.website')
@section('content')
<section class="clean-block clean-hero"
    style="background-image: url({{ $hero->image->url }});color: rgba(5, 79, 119, 0.50);">
    <div class="text">
        <h2>{{ $hero->title }}</h2>
        <p>{{ $hero->subtitle }}</p><a class="btn btn-outline-light btn-lg" href="{{ $hero->link }}">{{ $hero->button
            }}</a>
    </div>
</section>
<section class="clean-block clean-info dark">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">{{ $info->title }}</h2>
            <p>{{ $info->description }}</p>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6"><img class="img-thumbnail" src="{{ $info->image->url }}">
            </div>
            <div class="col-md-6">
                {!! $info->text !!}
                <a class="btn btn-outline-primary btn-lg" href="{{ $info->link }}">{{ $info->button }}</a>
            </div>
        </div>
    </div>
</section>
<section class="clean-block features" style="background: var(--bs-gray-900);color: rgb(255,255,255);">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">Atividades</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($activities as $activity)
            <div class="col-md-5 feature-box"><i class="{{ $activity->icon }}"></i>
                <h4>{{ $activity->title }}</h4>
                <p>{{ $activity->description }}</p><a class="btn btn-primary btn-sm" role="button"
                    href="{{ $activity->link }}">{{ $activity->button }}</a>
            </div>
            @endforeach
            <div class="col-md-5 feature-box"></div>
        </div>
    </div>
</section>
<section class="clean-block clean-testimonials dark">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">Testemunhos</h2>
        </div>
        <div class="row">
            @foreach ($testimonials as $testimonial)
            <div class="col-lg-4">
                <div class="card clean-testimonial-item border-0 rounded-0">
                    <div class="card-body">
                        <p class="card-text">{{ $testimonial->message }}</p>
                        <h3>{{ $testimonial->name }}</h3>
                        <h4 class="card-title">{{ $testimonial->job_position }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection