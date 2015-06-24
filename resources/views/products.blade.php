<h1>Listagem de Produtos</h1>

<ul>
    @foreach($products as $product)
        <li>
            {{ $product->name }} | {{ $product->description }}
            <br><b>R$</b> {{ $product->price }}
        </li>
    @endforeach
</ul>