@extends('layouts.app') 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
@section('content')
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
        
        <ul class="nav justify-content-center">
        @if(Auth::guest())
          <li class="nav-item">
                <a class="nav-link" href="/posts">Gost Pristup</a>
            </li>
        @endif
        @if(!Auth::guest())
          <li class="nav-item">
                <a class="nav-link" href="/home"><b>Nazad na prijavljenu stranicu</b></a>
            </li>
        @endif
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Registracija</a>
          </li>
        </ul>
        
      </div>
    </div>
  </div>
  
    <center><h1>Dobrodošli</h1></center>
    <center><b><h3> Ovo je laravel aplikacija za prikaz nastavnog plana.</h3> </b></center>
    <center><b> Za nastavničke aktivnosti molimo vas prijavite se. </b></center>
@endsection
