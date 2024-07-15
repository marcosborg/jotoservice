@extends('layouts.website')
@section('title')
{{ $transferTour->name }}
@endsection
@section('description')
{!! Illuminate\Support\Str::limit(strip_tags($transferTour->description), 150) !!}
@endsection
@section('content')
<section class="clean-block clean-product dark mt-5">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">{{ $transferTour->name }}</h2>
        </div>
        <div class="block-content">
            <div class="product-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="gallery">
                            <div id="product-preview" class="vanilla-zoom">
                                <div class="zoomed-image"></div>
                                <div class="sidebar">
                                    @foreach ($transferTour->photo as $photo)
                                    <img class="img-fluid d-block small-preview" src="{{ $photo->url }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <div class="price">
                                @if ($transferTour->under_consultation)
                                <h3>Preço sob consulta</h3>
                                @else
                                <h1>€ {{ $transferTour->price }}</h1>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="button" onclick="openTransferTourModal()"><i class="icon-basket"></i>
                                {{ $transferTour->under_consultation ? 'Pedir cotação' : 'Solicitar reserva' }}
                            </button>
                            <div class="summary">
                                {!! $transferTour->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="transferTourModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $transferTour->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forms/transferTourContact" method="post" id="transferTourContact">
                @csrf
                <input type="hidden" name="id" value="{{ $transferTour->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="text" id="city" name="city" class="form-control">
                    </div>
                    <div class="form-group mt-4">
                        <label for="message">Mensagem</label>
                        <textarea name="message" id="message" class="form-control"></textarea>
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="rgpd" name="rgpd">
                        <label class="form-check-label" for="rgpd">
                            Autorizo o tratamento dos dados fornecidos
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Pedir contacto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection