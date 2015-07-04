@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Tags</h1>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-default">New tag</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('admin.tags.edit', ['id'=>$tag->id]) }}"
                               title="Edit tag: {{ $tag->name }}"
                               class="glyphicon glyphicon-edit"></a> |
                            <a href="{{ route('admin.tags.destroy', ['id'=>$tag->id]) }}"
                               title="Delete tag: {{ $tag->name }}"
                               class="glyphicon glyphicon-trash"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $tags->render() !!}
    </div>
@endsection