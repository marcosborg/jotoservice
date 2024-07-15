@extends('layouts.website')
@section('title')
{{ $page->title }}
@endsection
@section('description')
{{ strstr($page->description, 'iframe') ? 'Contactos da empresa ExpertCom.' : $page->description }}
@endsection
@section('content')
<section class="clean-block clean-post dark">
    <div class="container" id="page">
        <div class="block-content">
            @if ($page->image)
            <div class="post-image" style="background-image: url('{{ $page->image->url }}');"></div>
            @endif
            <div class="post-body">
                <h3>
                    {{ $page->title }}
                    <button class="btn btn-success float-end" onclick="openPageModal()">Pedir contacto</button>
                </h3>
                <hr>
                <p>{!! $page->description !!}</p>
                {!! $page->text !!}
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="pageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">{{ $page->title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forms/pageContact" method="post" id="pageContact">
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
@endsection