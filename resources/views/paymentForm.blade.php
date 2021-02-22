@extends('base')


@section('main')
<div class="card mt-5 p-4">
<h1 class="text-center">Payment Form</h1>
<form action="{{url('/paymentSuccess/')}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
</div>

@endsection

@section('scripts')
    @parent
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"></script>
    
@endsection