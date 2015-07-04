@extends('store.template')

@section('categories')
    @include('store.partials.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Em destaque</h2>
            @include('store.partials.products', ['products' => $featured])
        </div><!--features_items-->

        <div class="features_items"><!--recommended-->
            <h2 class="title text-center">Recomendados</h2>
            @include('store.partials.products', ['products' => $recommended])
        </div><!--recommended-->
    </div>
@stop