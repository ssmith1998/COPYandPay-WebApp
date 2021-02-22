@extends('base')

@section('main')
<div class="successWrapper container">
<div class="card mt-5 p-4">
<h1 class="text-center">Success</h1>
<span class="text-center">ResultCode: {{$code}}</span>
<span class="text-center">ResultDescription: {{$desc}}</span>
<a class="text-center" href="{{url('/dashboard')}}">Back to Dashbaord</a>
</div>
</div>

@endsection