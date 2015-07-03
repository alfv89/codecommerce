@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Upload Image</h1>
        <br><br>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['route'=>['admin.products.images.store', $product->id], 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('image', 'Image', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('image', null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Upload Image', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.products') }}" class="btn btn-default">Back</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection