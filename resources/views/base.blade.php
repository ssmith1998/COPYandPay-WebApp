<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Payment Web App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header class="w-100 bg-light py-4 shadow">
@if (Auth::check())
<div class="row">
<div class="col-6">
<h1 class="text-center">Laravel Payment Web App</h1>
</div>
<div class="col-6 d-flex align-items-center justify-content-center">
 
    <span>{{ Auth::user()->email }}</span>
     <a class="ml-2" href="/logout"><i class="fas fa-sign-out-alt"></i></a> 
 
</div>
</div>
@else
<h1 class="text-center">Laravel Payment Web App</h1>
@endif
    
   

</header>
    
    <div class="container">
    @yield('main')
    </div>
</body>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/f2e27c939b.js" crossorigin="anonymous"></script>

    @show



</html>