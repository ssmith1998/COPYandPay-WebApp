@extends('base')



@section('main')
<div class="loginWrapper pt-4 h-100 w-100">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card p-4 mt-5">
<h3 class="text-center">Login</h3>
@if ($errors->any())
        <div class="alert alert-danger w-100 text-center">
        
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span><br/>
            @endforeach
     
    </div>
@endif
 <form  action="{{url('/login/user')}}" method="POST" class="w-100">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email" value="{{ old('email') }}">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
  </div>
  <div class="btnWrapper text-center">
  <button type="submit" class="btn btn-primary w-50">Login</button>
  </div>
</form>

<div class="registerLink text-center pt-3">
<a href="/register">Not signed up? Register here!</a>
</div>
</div>
</div>
@endsection


