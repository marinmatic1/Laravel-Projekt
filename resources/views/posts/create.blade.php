@extends('layouts.app')

@section('content')
<div style="margin:5%">
    <center><h1>Kreiraj Post, Nastavni Plan</h1></center>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST','enctype'=> 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Naslov')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' =>'Naslov..'])}}
        </div>
        <div class="form-group">
                {{Form::label('body', 'Sadržaj')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' =>'Sadržaj..'])}}
        </div>

<div class="form-group">
    {{Form::file('cover_image')}}
</div>
        {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    <p align="right"><a href="/home" class="btn btn-primary">Nazad</a></p>
    </div>
    @endsection