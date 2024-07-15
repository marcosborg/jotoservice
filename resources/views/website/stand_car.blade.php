@extends('layouts.website')
@section('title')
Compre a sua viatura {{ $car->brand->name }} {{ $car->car_model->name }}
@endsection
@section('description')
{{ $car->brand->name }} {{ $car->car_model->name }} preparado para utilização TVDE. Apenas {{ $car->price }}€
@endsection
@section('content')
<section class="clean-block clean-product dark mt-5">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">{{ $car->brand->name }} {{ $car->car_model->name }}</h2>
        </div>
        <div class="block-content">
            <button class="btn btn-light ms-3" onclick="history.back()"><i class="fas fa-arrow-left icon"></i></button>
            <div class="product-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="gallery">
                            <div id="product-preview" class="vanilla-zoom">
                                <div class="zoomed-image"></div>
                                <div class="sidebar" style="width: 100%; display: block;">
                                    @foreach ($car->images as $image)
                                    <img class="img-fluid d-block small-preview" style="float: left;" src="{{ $image->url }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <div class="price">
                                <div class="mb-4">
                                    <h1><small>€</small> {{ $car->price }}</h1>
                                    @if ($car->status->id == 1)
                                    <span class="badge bg-danger">Vendido</span>
                                    @else
                                    <span class="badge bg-success">Disponível</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <script>console.log({!! $car !!})</script>
                                    <div class="col">
                                        <p><strong>Ano: </strong>{{ $car->year }} | {{ $car->month->name }}</p>
                                        <p><strong>Quilómetros: </strong>{{ $car->kilometers }} km</p>
                                        <p><strong>Caixa: </strong>{{ $car->transmision }}</p>
                                        <p><strong>Combustivel: </strong>{{ $car->fuel->name }}</p>
                                    </div>
                                    <div class="col">
                                        @if ($car->battery_capacity)
                                        <p><strong>Capacidade da bateria: </strong>{{ $car->battery_capacity }} kWh</p>
                                        @else
                                        <p><strong>Cilindrada: </strong>{{ $car->cylinder_capacity }} cm3</p>
                                        @endif
                                        <p><strong>Potência: </strong>{{ $car->power }} CV</p>
                                        <p><strong>Origem: </strong>{{ $car->origin->name }}</p>
                                        <p><strong>Localidade: </strong>{{ $car->distance }}</p>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" onclick="openstandCarModal()">
                                Pedir contacto
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="standCarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $car->brand->name }} {{ $car->car_model->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forms/standCarContact" method="post" id="standCarContact">
                <input type="hidden" name="id" value="{{ $car->id }}">
                @csrf
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
<script>
    console.log({!! $car !!})
</script>
@endsection