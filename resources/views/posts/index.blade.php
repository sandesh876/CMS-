@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
</div>

<div class="card card-default">
    <div class="card-header">Posts</div>

    @if ($posts->count()>0)
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{asset("storage/".$post->image)}}" alt="" style=" height:60px;
                            width: 120px;
                            background-size: cover;
                            margin: 0 auto;">
                            
                        </td>
                        <td>
                            {{$post->title}}
                        </td>
                        @if (!$post->trashed())
                        <td>
                            <a href="" class="btn btn-info btn-sm float-right">Edit</a>
                        </td>
                        @endif
                        <td>
                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                {{$post->trashed() ? 'Delete': 'Trash' }}
                            </button>
                           </form>
                        </td>

                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
    @else

    <p class="text-center mt-2">No Posts Yet</p>
        
    @endif
</div>

@endsection