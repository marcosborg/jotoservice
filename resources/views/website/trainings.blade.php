@extends('layouts.website')
@section('title')
Formação TVDE
@endsection
@section('description')
A formação TVDE é obrigatória para a atividade. Inscrição em cursos 100% online. Dê o 1 passo na actividade TVDE.
@endsection
@section('content')
<section class="clean-block clean-post dark">
    <div class="container">
        <div class="block-content">
            <div class="post-image" style="background-image: url('{{ $training->image->url }}');"></div>
            <div class="post-body">
                <h3>
                    {{ $training->title }}
                    <button class="btn btn-success float-end" onclick="openTrainingModal()">Pedir contacto</button>
                </h3>
                <hr>
                <p>{{ $training->description }}</p>
                {!! $training->text !!}
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="trainingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $training->title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forms/trainingContact" method="post" id="trainingContact">
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