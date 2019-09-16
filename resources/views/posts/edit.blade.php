@extends('layouts.app')

@section('content')

    <center><h1>Preoblikuj Nastavni Plan</h1></center>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST','enctype'=> 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form::label('title', 'Naslov')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' =>'Naslov..'])}}
        </div>
        <div class="form-group">
                {{Form::label('body', 'Sadržaj')}}
                {{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' =>'Sadržaj..'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Spremi',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    <p align="right"><a href="/posts" class="btn btn-primary">Nazad</a></p>
@endsection