@extends('layouts.website')
@section('title')
Stand de venda
@endsection
@section('description')
Compre a sua viatura preparada para utilização TVDE. Viaturas completamente adquadas à legislação em vigor.
@endsection
@section('content')
<section class="clean-block clean-catalog dark mt-5">
    <div class="container">
        <div class="block-heading">
            <h2 class="text-info">Stand</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="products" id="standProduct"></div>
                </div>
                <div class="col-md-3">
                    <div class="d-none d-md-block">
                        <div class="filters" style="width: 240px;">
                            <div class="filter-item">
                                <h3>Procura</h3>
                                <div class="form-group" style="margin-bottom: 11px;"><select
                                        class="js-example-basic-single form-control">
                                        <option selected disabled>Marca</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select></div>
                                <div class="form-group" style="margin-bottom: 11px;"><select
                                        class="js-example-basic-single form-control">
                                        <option selected disabled>Modelo</option>
                                        @foreach ($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                                        @endforeach
                                    </select></div>
                                <div class="form-group" style="margin-bottom: 11px;"><select
                                        class="js-example-basic-single form-control">
                                        <option selected disabled>Max Ano</option>
                                        @foreach ($years as $key => $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select></div>
                                <div class="form-group" style="margin-bottom: 11px;"><select
                                        class="js-example-basic-single form-control">
                                        <option selected disabled>Caixa</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Auto">Auto</option>
                                    </select>
                                    <div class="d-grid gap-2"><button class="btn btn-outline-primary" type="button"
                                            style="margin-top: 20px;">Filtrar</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-none"><a class="btn btn-link d-md-none filter-collapse" data-bs-toggle="collapse"
                            aria-expanded="false" aria-controls="filters" href="#filters" role="button">Filters<i
                                class="icon-arrow-down filter-caret"></i></a>
                        <div class="collapse" id="filters">
                            <div class="filters">
                                <div class="filter-item">
                                    <h3>Procura</h3>
                                    <div class="form-group" style="margin-bottom: 11px;"><select class="form-control">
                                            <option selected disabled>Marca</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select></div>
                                    <div class="form-group" style="margin-bottom: 11px;"><select class="form-control">
                                            <option selected disabled>Modelo</option>
                                            @foreach ($models as $model)
                                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                                            @endforeach
                                        </select></div>
                                    <div class="form-group" style="margin-bottom: 11px;"><select class="form-control">
                                            <option value="12" selected=""></option>
                                        </select></div>
                                    <div class="form-group" style="margin-bottom: 11px;"><select class="form-control">
                                            <option value="12" selected="">Caixa</option>
                                        </select>
                                        <div class="d-grid gap-2"><button class="btn btn-outline-primary" type="button"
                                                style="margin-top: 20px;">Filtrar</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection