@extends('layouts.website')
@section('title')
Transfer's & Tours
@endsection
@section('description')
Serviço de transfer privado com toda a comodidade de um serviço exclusivo TVDE.
@endsection
@section('content')
<section class="clean-block clean-services dark mt-5">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">Transfer's &amp; Tours</h2>
        </div>
        <div class="row">
            @foreach ($transfer_tours as $transfer_tour)
            <div class="col-md-6 col-lg-4">
                <div class="card"><img class="card-img-top w-100 d-block" src="{{ $transfer_tour->photo[0]->url }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $transfer_tour->name }}</h4>
                        <span class="card-text">{!! Illuminate\Support\Str::limit($transfer_tour->description, 150) !!}</span>
                        <h3>
                            @if ($transfer_tour->under_consultation)
                            Preço sob consulta 
                            @else
                            €{{ $transfer_tour->price }}
                            @endif
                        </h3>
                    </div>
                    <div><a class="btn btn-outline-primary btn-sm" role="button"
                            href="/tvde/transfer-tour/{{ $transfer_tour->id }}" style="margin-bottom: 20px;">Saber
                            mais</a></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection