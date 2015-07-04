@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Create Product</h1>
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

        {!! Form::open(['route'=>'admin.products.store', 'class'=>'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Price', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-3 input-group">
                    <div class="input-group-addon">$</div>
                    {!! Form::text('price', null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('featuredOpt', 'Featured', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <label class="radio-inline">
                        {!! Form::radio('featured', 1) !!} Yes
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('featured', 0, true) !!} No
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('recommendOpt', 'Recommend', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <label class="radio-inline">
                        {!! Form::radio('recommend', 1) !!} Yes
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('recommend', 0, true) !!} No
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category', 'Category', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('tags', 'Tags', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('tags[]', $tags, null, ['class'=>'form-control', 'multiple']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Add product', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.products') }}" class="btn btn-default">Back</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection