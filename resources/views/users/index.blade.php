@extends('layouts.app')

@section('content')


<div class="card card-default">
    <div class="card-header">Users</div>

    @if ($users->count()>0)
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>

            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                           <img width="40px" height="40px" style="border-radius:50%" src="{{Gravatar::src($user->email)}}" alt=""> 
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                       {{$user->email}}
                        </td>
                        <td>
                            @if (!$user->isAdmin())
                        <form action="{{route('users.make-admin',$user->id)}}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                        </form>
                            @endif
                        </td>
                    @endforeach
            </tbody>
        </table>
    </div>
    @else

    <p class="text-center mt-2">No Users Yet</p>
     @endif 
   
</div>

@endsection