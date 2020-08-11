@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Tags
    </div>
    @if ($tags->count()>0)
    <div class="card-body">
      <table class="table">
          <thead>
              <th>Name</th>
              <th>Posts Count</th>
              <th></th>
          </thead>
          <tbody>
              @foreach ($tags as $tag)
              <tr>
                  <td>
                      {{$tag->name}}
                   </td> 
                   <td>
                    {{$tag->posts->count()}}
                   </td>
                   <td>
                   <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">Edit</a>
                   
                   <button class="btn btn-danger btn-sm ml-0" onclick="handleDelete({{$tag->id}})">Delete</button>

                   </td>
              </tr>
          
              @endforeach
          </tbody>
      </table>
    </div>
    @else
    <p class="text-center mt-2">No tags yet</p>
        
    @endif
        <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="" method="POST" id="deleteTagForm">
          @csrf
          @method('DELETE')
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center text-bold">
                Are you sure you want to delete this Tag?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go Back</button>
              <button type="submit" class="btn btn-danger">Yes,Delete</button>
            </div>
          </div>
      </form>
  </div>
    </div>
</div>
@endsection


@section('script')
<script>

function handleDelete(id){

var form = document.getElementById('deleteTagForm')
form.action = '/tags/'+id

$('#deleteModal').modal('show')

}


</script>
@endsection