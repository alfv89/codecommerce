@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Editing Product: {{ $product->name }}</h1>
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

        {!! Form::open(['route'=>['admin.products.update', $product->id], 'method'=>'put', 'class'=>'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Price', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-3 input-group">
                    <div class="input-group-addon">$</div>
                    {!! Form::text('price', $product->price, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('featuredOpt', 'Featured', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <label class="radio-inline">
                        {!! Form::radio('featured', 1, ($product->featured)?true:false) !!} Yes
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('featured', 0, (!$product->featured)?true:false) !!} No
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('recommendOpt', 'Recommend', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <label class="radio-inline">
                        {!! Form::radio('recommend', 1, ($product->recommend)?true:false) !!} Yes
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('recommend', 0, (!$product->recommend)?true:false) !!} No
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category', 'Category', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('category_id', $categories, $product->category->id, ['class'=>'form-control']) !!}
                </div>
            </div>

            {{--<div class="form-group">--}}
                {{--{!! Form::label('tags', 'Tags', ['class'=>'col-sm-2 control-label']) !!}--}}
                {{--<div class="col-sm-10">--}}
                    {{--{!! Form::select('tags[]', $tags, $product->tags->lists('id')->toArray(), ['class'=>'form-control', 'multiple']) !!}--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                {!! Form::label('tags', 'Tags', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('tags', $product->tagList, ['rows'=>'3', 'placeholder'=>'As tags devem ser separadas por virgula. Ex.: tag1, tag2', 'class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Save product', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.products') }}" class="btn btn-default">Back</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection