@extends('products.layout')
@section('content')
    <!-- Your HTML code for the header -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
               

            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->description }}</td>
            <td>
            
                <a class="btn btn-info" href="{{ route('products.show', $post->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('products.edit', $post->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection
