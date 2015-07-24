@extends('store.template')

@section('content')
    <div class="container">
        <h3>Meus pedidos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Itens</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            <ul>
                                @foreach($order->items as $item)
                                    <li>{{ $item->product->name }} (Quantiade: {{ $item->qtd }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($order->total, 2, ',', '.') }}</td>
                        <td>{{ $order->status->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum pedido encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@stop