@extends('layouts.app')

@section('content')
<div class="container" align="center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Prijavljeni ste!</h1>
                    <p>Imate mogućnost dodavanja nastavnog sadržaja.</p>
                    <a href="/posts/create">Stvori Novi Nastavni Plan</a>
                    <br>
                    <a href="/posts">Pregledaj Postojeće Nastavne Planove</a>
                    @if(count($posts)>0)
                   <table class="table table-striped">
                        <tr>
                            <th>Naslov</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Izmjeni</a></td>
                                <td>
                                        {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                   </table>
                   @else
                        <p>Trenutno nemate planova</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
