@extends('layouts.app')

@section('content')
<div style="margin:5%">
<h1>{{$post->title}}</h1>
<img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
<br><br>
<div>
    {!!$post->body!!}
</div>
<hr>
<small>Written on {{$post->created_at}} Stvorio nastavnik: <b>{{$post->user->name}}</b></small>
<hr>
@if(!Auth::guest())

    @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
        
        {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
    
    @endif

<p align="right"><a href="/posts" class="btn btn-primary">Nazad</a></p>

@endif
</div>
@endsection