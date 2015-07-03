@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Images of {{ $product->name }}</h1>
        <a href="{{ route('admin.products.images.create', ['id'=>$product->id]) }}" class="btn btn-default">New image</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Extension</th>
                    <th>MimeType</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->images as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td>
                            <img src="{{ url('uploads/'.$image->name) }}" width="50" />
                        </td>
                        <td>{{ $image->name }}</td>
                        <td>{{ $image->extension }}</td>
                        <td>{{ $image->mime }}</td>
                        <td>{{ $image->size }}</td>
                        <td>
                            <a href="{{ route('admin.products.images.destroy', ['id'=>$image->id]) }}"
                               title="Delete image: {{ $image->name }}"
                               class="glyphicon glyphicon-trash"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.products') }}" class="btn btn-default">Back</a>
    </div>
@endsection