@extends('layouts.website')
@section('title')
FAQS
@endsection
@section('description')
Veja aqui as respostas mais comuns ás suas questões relacionadas com o ExpertCom.
@endsection
@section('content')
<section class="clean-block clean-post dark">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">FAQS</h2>
        </div>
        <div class="block-content">
            <div class="accordion" id="accordion">
                @foreach ($faqs as $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                        data-bs-parent="#accordion">
                        <div class="accordion-body">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection