@extends('layouts.website')
@section('title')
Aluguer de viaturas
@endsection
@section('description')
Aqui, encontrará soluções para alugar a sua viatura TVDE e começar o trabalho que tanto deseja como motorista.
@endsection
@section('content')
<section class="clean-block clean-blog-list dark pt-5">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">Aluguer de viaturas</h2>
        </div>
        <div class="block-content">
            @foreach ($cars as $car)
            <div class="clean-blog-post">
                <div class="row">
                    <div class="col-lg-6">
                        @if ($car->photo->url)
                        <img class="rounded img-fluid mb-4" src="{{ $car->photo->url }}" width="300">    
                        @endif
                        <h3><span style="color: rgb(85, 85, 85); text-transform: uppercase">{{ $car->title }}</span><br>
                        </h3><span class="text-muted">{{ $car->subtitle }}</span>
                        <p class="fw-bold"><span style="color: rgb(108, 117, 125);">Desde €{{ $car->price }} por
                                semana*</span><br></p>
                    </div>
                    <div class="col-lg-6">
                        <div style="margin-left: 59px;">
                            <p><strong><span style="color: rgb(85, 85, 85);">Especificações:</span></strong><br></p>
                            {!! $car->specifications !!}
                            <button onclick="openCarModal({{ $car->id }})" class="btn btn-outline-primary btn-sm"
                                type="button" style="margin-top: 20px;">Pedir
                                contacto</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="carModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/forms/carRentalContact" method="post" id="carRentalContact">
                @csrf
                <input type="hidden" id="car_id" name="car_id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Pedido de contacto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 id="car_title"></h2>
                    <h3 id="car_subtitle"></h3>
                    <hr>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="text" class="form-control" name="city" id="city">
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tvde" name="tvde">
                                <label class="form-check-label" for="tvde">
                                    Tem cartão TVDE?
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" id="tvde_card" name="tvde_card" class="form-control d-none"
                                    placeholder="Número">
                            </div>
                        </div>
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