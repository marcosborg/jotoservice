@extends('layouts.website')
@section('title')
{{ $legal->title }}
@endsection
@section('description')
{{ $legal->title }} do ExpertCom
@endsection
@section('content')
<section class="clean-block clean-post dark">
    <div class="container">
        <div class="block-content">
            <div class="post-body">
                <h3>{{ $legal->title }}</h3>
                <hr>
                {!! $legal->text !!}
            </div>
        </div>
    </div>
</section>
@endsection