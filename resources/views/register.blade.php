@extends('base')

@section('main')
<div class="registerWrapper pt-4 d-flex flex-column justify-content-center align-items-center">

<h3 class="text-center">Register</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 <form action="{{url('/register/user')}}" method="POST" class="w-100">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
  </div>
  <div class="btnWrapper text-center">
  <button type="submit" class="btn btn-primary w-50">Register</button>
  </div>
</form>

<div class="registerLink text-center pt-3">
<a href="/">already have an account? Login here!</a>
</div>
</div>
@endsection