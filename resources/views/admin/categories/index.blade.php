@extends('admin.template')

@section('content')
    <div class="container">
        <h1>Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-default">New category</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['id'=>$category->id]) }}"
                               title="Edit category: {{ $category->name }}"
                               class="glyphicon glyphicon-edit"></a> |
                            <a href="{{ route('admin.categories.destroy', ['id'=>$category->id]) }}"
                               title="Delete category: {{ $category->name }}"
                               class="glyphicon glyphicon-trash"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection