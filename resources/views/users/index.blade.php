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
                            
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                       {{$user->email}}
                        </td>
                        <td>
                            @if (!$user->isAdmin())
                            <button class="btn btn-success btn-sm">Make Admin</button>
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