@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alerct-success">
        {{session('sucess')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alerct-danger">
        {{session('error')}}
    </div>
@endif
