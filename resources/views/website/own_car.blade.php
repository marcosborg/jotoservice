@extends('layouts.website')
@section('title')
Trabalhar com viatura própria
@endsection
@section('description')
Saiba tudo o que precisa fazer para rentabilizar a sua viatura e começar imediatamente a ganhar dinheiro.
@endsection
@section('content')
<section class="clean-block clean-post dark">
    <div class="container">
        <div class="block-content">
            <div class="post-image" style="background-image: url('{{ $ownCar->image->url }}');"></div>
            <div class="post-body">
                <h3>
                    {{ $ownCar->title }}
                    <button class="btn btn-success float-end" onclick="openOwnCarModal()">Pedir contacto</button>
                </h3>
                <hr>
                <p>{{ $ownCar->description }}</p>
                {!! $ownCar->text !!}
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ownCarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $ownCar->title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forms/ownCarContact" method="post" id="ownCarContact">
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
                    <div class="form-group">
                        <label for="city">Cidade</label>
                        <input type="text" id="city" name="city" class="form-control">
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