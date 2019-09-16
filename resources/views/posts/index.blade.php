@extends('layouts.app')

@section('content')
<head>
<style>
        body {
            margin-right:100px;
    }
    </style>
    </head>
<body>
    <h1 style="margin:50px">Posts</h1>

    @if(count($posts)>0)
        @foreach($posts as $post)
            <div style="margin:5%" class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-4 col-sm-4">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written on {{$post->created_at}} Stvorio nastavnik: <b>{{$post->user->name}}</b></small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif

    <p align="right"><a href="/home" class="btn btn-primary">Nazad</a></p>
@endsection
</body>