@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Create Tag</h1>
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

        {!! Form::open(['route'=>'admin.tags.store', 'class'=>'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Add category', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.tags') }}" class="btn btn-default">Back</a>
                </div>
            </div>

        {!! Form::close() !!}
    </div>
@endsection