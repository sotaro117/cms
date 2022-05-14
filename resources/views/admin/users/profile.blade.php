<x-admin-master>
  @section('content')
      <h1>User Profile: {{$user->name}}</h1>

      <div class="row">
        <div class="col-sm-6">
          <form action="{{route('user.profile.update', $user)}}" method='post' enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class='mb-4'>
              <img src="{{$user->avatar}}" alt="" class='img-profile rounded-circle'>
            </div>
            <div class="gorm-group">
              <input type="file" name='avatar'>
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name='username' class='form-control @error('username') is-invalid @enderror' id='username' value={{$user->username}}>
              @error('username')
                  <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name='email' class='form-control' id='email' value={{$user->email}}>
              @error('email')
                  <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name='password' class='form-control' id='password'>
              @error('password')
                  <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password-confirm">Confirm Password</label>
              <input type="password" name='password-confirm' class='form-control' id='password-confirm'>
              @error('password-confirm')
                  <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
          </form>
        </div>
      </div>
  @endsection
</x-admin-master>