@extends('Layouts.app')

@section('content')
<form method="POST" action="{{ route('update.user') }}" class="container mt-5 d-flex flex-column sign-in">
    @csrf
    <input type="hidden"  name="id" value="{{ $user->id }}">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">username</label>
        <input disabled type="text" value="{{ $user->username }}" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="full_name" class="form-label">Full name</label>
        <input type="text" value="{{ $user->full_name }}" class="form-control" name="full_name" id="full_name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" value="{{ $user->password }}" class="form-control" name="password" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn mt-3 btn-primary">Update</button>
</form>


@endsection