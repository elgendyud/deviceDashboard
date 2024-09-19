@extends('Layouts.app')

@section('content')


@if(Session::has('success'))
  <div class="alert alert-success container mt-5" style="text-align: center; width: 100%">
    {{ Session::get('success') }}
  </div>
  @endif

<form method="POST" action="{{ route('changePass.user') }}" class="container mt-5 d-flex flex-column sign-in">
  <h2 style='text-align:center; margin-bottom: 10px'>Change Password</h2>
    @csrf
    <input type="hidden"  name="id" value="{{ $user->id }}">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">username</label>
        <input disabled type="text" value="{{ $user->username }}" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" value="{{ $user->password }}" class="form-control" name="password" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn mt-3 btn-primary">Update</button>
</form>

@endsection