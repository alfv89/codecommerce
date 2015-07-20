@extends('store.template')

@if($order == 'empty')
    @section('categories')
        @include('store.partials.categories')
    @stop
@endif

@section('content')
    <div class="col-sm-9 padding-right">
        @if($order == 'empty')
            <h3>Carrinho de compras vazio.</h3>
        @else
            <h3>Pedido realizado com sucesso!</h3>
            <p>O pedido #{{ $order->id }}, foi realizado com sucesso.</p>
        @endif
    </div>
@stop