@extends('store.template')

@section('categories')
    @include('store.partials.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    @if(count($product->images))
                        <img src="{{ url('uploads/' . $product->images->first()->name) }}" />
                    @else
                        <img src="{{ url('images/no-img.jpg') }}" />
                    @endif
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($product->images as $images)
                                <a href="#"><img src="{{ url('uploads/' . $images->name) }}" alt="" width="80"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <h2>{{ $product->category->name }} :: {{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <span>
                        <span>R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            <a href="{{ route('store.cart.add', ['id' => $product->id]) }}" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Adicionar no Carrinho
                            </a>
                    </span>
                </div>
                <!--/product-information-->
                <br>
                <div class="product-information">
                    <h2>Tags</h2>
                    @foreach($product->tags as $index => $tag)
                        <a href="{{ route('store.tag', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                        {{ ($index + 1 < count($product->tags)) ? ',' : '' }}
                    @endforeach
                </div>
            </div>
        </div>
        <!--/product-details-->
    </div>
@stop