@extends('base')


@section('main')
<div class="card p-5 mt-5">
<h1 class="text-center mt-2">Dashboard</h1>
@if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row">
<div class="col-lg-12">
<div class="card mt-5 p-4">
<h3 class="text-center">Make a payment</h3>
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
<div class="col-lg-12">
<div class="card mt-5 p-4" id="paymentsList">
<h4 class="text-center">Previous Payments</h4>
@if ($user->payments->count() > 0 )
<div class="table-responsive-md">
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Reference</th>
      <th>Amount</th>
      <th>Date</th>
      <th>refunded</th>
      <th>Refund Reference</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  
  @foreach ($user->payments as $payment)
   <tr>
      <th scope="row">{{$payment->id}}</th>
      <td>{{$payment->reference}}</td>
      <td>£{{$payment->amount}}</td>
      <td>{{ date('d-m-y h:i:sa', strtotime($payment->timestamp)) }}</td>
      <td>{{ $payment->isRefunded == false ? 'No' : 'Yes' }}</td>
      <td>{{ $payment->refundReference == null ? 'N/A' : $payment->refundReference }}</td>
      @if($payment->isRefunded == false)
    <td><a href="{{url('/refund') . '?' . http_build_query(['payment' => $payment->id])}}"><span>Refund</span></a></td> 
    @endif
    </tr>   
  @endforeach


  </tbody>
</table>

</div>

  @else
  
<div class="alert alert-info text-center p-3" role="alert">
  You have no payments to show!
</div>
    @endif
</div>

</div>
</div>
</div>




@endsection