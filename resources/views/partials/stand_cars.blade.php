@foreach ($stand_cars as $stand_car)
<div class="row g-0 product" onclick="goStandCar({{ $stand_car->id }})">
    <div class="col-12 col-md-6 col-lg-4">
        @if ($stand_car->images->count() > 0)
        <div class="image"><img class="img-fluid d-block mx-auto" src="{{ $stand_car->images[0]->url }}"></div>
        @endif
    </div>
    <div class="col">
        <div style="margin-left: 20px;">
            <div class="row">
                <div class="col">
                    <p class="fw-bold text-uppercase">{{ $stand_car->brand->name }} {{
                        $stand_car->car_model->name }}</p>
                </div>
                <div class="col text-end">
                    @if ($stand_car->status->id == 1)
                    <span class="badge bg-danger">Vendido</span>
                    @else
                    <span class="badge bg-success">Disponível</span>
                    @endif
                </div>
            </div>
            <h3><small>€</small> {{ $stand_car->price }}</h3>
            <div class="row">
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Combustivel</span><br>
                    <span>{{ $stand_car->fuel->name }}</span>
                </div>
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Mês</span><br>
                    <span>{{ $stand_car->month->name }}</span>
                </div>
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Ano</span><br>
                    <span>{{ $stand_car->year }}</span>
                </div>
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Quilómetros</span><br>
                    <span>{{ $stand_car->kilometers }} km</span>
                </div>
            </div>
            <div class="row">
                @if ($stand_car->battery_capacity)
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Cap. da bateria</span><br>
                    <span>{{ $stand_car->battery_capacity }} kWh</span>
                </div>
                @else
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Cilindrada</span><br>
                    <span>{{ $stand_car->cylinder_capacity }} cm3</span>
                </div>
                @endif
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Potência</span><br>
                    <span>{{ $stand_car->power }} CV</span>
                </div>
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Origem</span><br>
                    <span>{{ $stand_car->origin->name }}</span>
                </div>
                <div class="col" style="font-size: 12px">
                    <span class="text-uppercase fw-bold">Localidade</span><br>
                    <span>{{ $stand_car->distance }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ $stand_cars->links() }}
<script>
    $('a.page-link').click(function(event){
        event.preventDefault();
        let page = $(this).attr('href').split('?page=')[1];
        $('#standProduct').fadeOut();
        setTimeout(() => {
            $.get('/ajax/standCars?page=' + page).then((resp) => {
                $('#standProduct').html(resp);
                $('#standProduct').fadeIn();
            });
        }, 500);
    });
</script>