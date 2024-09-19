@extends('Layouts.app')

@section('content')
<table class="table container mt-5 table-striped">
  <h2 class="container mt-1">Users List</h2>
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Full Name</th>
      <th scope="col">Username</th>
      <th scope="col">Update</th>
      <th scope="col">Activation</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $index => $user)

    <tr>
      <th scope="row">{{$index + 1}}</th>
      <td>{{ $user->full_name }}</td>
      <td>{{ $user->username }}</td>
      <td><a href="{{ route('edit.user', $user->id) }}" type="button" class="btn btn-success">Update</a></td>
      @if ($user->username == 'admin')
      <!-- Update start -->
      <td>
      <form action="{{ route('users.toggleActive', $user->id) }}" method="GET">
      <button disabled type="submit" class="btn {{ $user->active ? 'btn-danger' : 'btn-success' }}">
        {{ $user->active ? 'Deactivate' : 'Activate' }}
      </button>
      </form>
    </td>

    @else
      <td>
      <form action="{{ route('users.toggleActive', $user->id) }}" method="GET">
      <button type="submit" class="btn {{ $user->active ? 'btn-danger' : 'btn-success' }}">
        {{ $user->active ? 'Deactivate' : 'Activate' }}
      </button>
      </form>
    </td>
    @endif

    </tr>

    <!-- Update end -->

  @endforeach
  </tbody>
</table>
<div class="container cont-create mt-5">
  <a href="{{ route('create.user') }}" class="btn btn-success container m-auto"> Create New User </a>
</div>


@endsection