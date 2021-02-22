@extends('base')


@section('main')
<h1 class="text-center mt-2">Dashbaord</h1>
<div class="row">
<div class="col-md-6">
<div class="card mt-5 p-4">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 <form  action="{{url('/copyandpay/setup')}}" method="POST" class="w-100">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="amount">Amount(£)</label>
    <input type="number" step="0.01" class="form-control" id="amount" aria-describedby="emailHelp" placeholder="Amount" name="amount" value="{{ old('amount') }}">
  </div>
  <div class="form-group">
    <label for="reference">Reference</label>
    <input type="text" class="form-control" id="reference" placeholder="Reference" name="reference" value="{{ old('reference') }}">
  </div>
  <div class="btnWrapper text-center">
  <button type="submit" class="btn btn-primary w-50">Submit</button>
  </div>
</form>
</div>
</div>
<div class="col-md-6">
<div class="card mt-5 p-4" id="paymentsList">
<h4 class="text-center">Previous Payments</h4>
@if ($user->payments->count() > 0 )
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Reference</th>
      <th>Amount</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach ($user->payments as $payment)
   <tr>
      <th scope="row">{{$payment->id}}</th>
      <td>{{$payment->reference}}</td>
      <td>£{{$payment->amount}}</td>
      <td>{{ date('d-m-y h:i:sa', strtotime($payment->timestamp)) }}</td>
    </tr>   
  @endforeach


  </tbody>
</table>

  @else
  
<div class="alert alert-info text-center p-3" role="alert">
  You have no payments to show!
</div>
    @endif
</div>

</div>
</div>




@endsection