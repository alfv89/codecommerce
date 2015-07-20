@extends('store.template')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table_condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Valor</td>
                            <td class="price" style="width: 150px;">Quantidade</td>
                            <td class="price">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart->all() as $k => $item)
                            <tr>
                                <td class="cart_product">
                                    <a href="{{ route('store.product', ['id' => $k]) }}">
                                        Imagem
                                    </a>
                                </td>

                                <td class="cart_description">
                                    <h4>
                                        <a href="{{ route('store.product', ['id' => $k]) }}">
                                            {{ $item['name'] }}
                                        </a>
                                    </h4>
                                    <p>Código: {{ $k }}</p>
                                </td>

                                <td class="cart_price">
                                    R$ {{ number_format($item['price'], 2, ',', '.') }}
                                </td>

                                <td class="cart_quantity">
                                    {!! Form::open(['route'=>['store.cart.change', $k], 'class'=>'form-horizontal']) !!}
                                        {!! Form::text('qtd', $item['qtd'], ['class'=>'form-control', 'style'=>'width: 50px; float: left; margin-right: 5px;']) !!}
                                        {!! Form::submit('Alterar', ['class'=>'btn btn-defaut']) !!}
                                    {!! Form::close() !!}
                                </td>

                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        R$ {{ number_format($item['price'] * $item['qtd'], 2, ',', '.') }}
                                    </p>
                                </td>

                                <td class="cart_delete">
                                    <a href="{{ route('store.cart.remove', ['id' => $k]) }}" class="cart_quanti_deletety">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Nenhum item encontrado no carrinho.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="cart_menu">
                            <td colspan="6">
                                <div class="pull-right">
                                    <span>
                                        Total: R$ {{ number_format($cart->getTotal(), 2, ',', '.') }}
                                    </span>

                                    <a href="{{ route('store.cart.checkout.place') }}" class="btn btn-success">Fechar a conta</a>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
@stop