@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Product: {{ $product->name }}</h1>
        <br><b>Name:</b> {{ $product->name }}
        <br><b>Description:</b> {{ $product->description }}
        <br><b>Price:</b> ${{ $product->price }}
        <br><b>Featured:</b> {!! ($product->featured) ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>' !!}
        <br><b>Recommended:</b> {!! ($product->recommend) ? '<i class="glyphicon glyphicon-ok"></i>' : '<i class="glyphicon glyphicon-remove"></i>' !!}
        <br><b>Category:</b> {{ $product->category->name }}
        <br><b>Tags:</b> {{ $product->tagList }}
        <br><b>Images:</b><br>
        @foreach($product->images as $image)
            <img src="{{ url('uploads/'.$image->name) }}" height="200" />
        @endforeach
        <br><br>
        <a href="{{ route('admin.products') }}" class="btn btn-default">Back</a>
    </div>
@endsection