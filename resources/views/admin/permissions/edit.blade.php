<x-admin-master>
  @section('content')
  @if (session()->has('permission-updated'))
    <div class="alert alert-primary">
      {{session('permission-updated')}}
    </div>
  @endif
  <div class="row">
    <div class="col-sm-6">
      <h1>Edit Permission: {{$permission->name}}</h1>
      <label for="name">Name</label>
      <form action="{{route('permissions.update', $permission->id)}}" method='post'>
      @csrf
      @method('PUT')
      <div class="form-group">
        <input type="text" name='name' id='name' class='form-control' value='{{$permission->name}}'>
      </div>
      <button class="btn btn-primary" type='submit'>Update</button>
      </form>
    </div>
  </div>
  @endsection
</x-admin-master>