@extends('Layouts.app')

@section('content')
@if ($errors->any())
        <div class="container alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
        </div>
    @endif
<form method="POST" action="{{ route('store.user') }}" class="container mt-5 d-flex flex-column sign-in">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">username</label>
        <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="full_name" class="form-label">Full name</label>
        <input type="text" class="form-control" name="full_name" id="full_name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
    </div>
    <input type="hidden" value="true" name="active">
    <button type="submit" class="btn mt-3 btn-primary">Create</button>
</form>


@endsection