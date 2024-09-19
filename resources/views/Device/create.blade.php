@extends('Layouts.app')

@section('content')
@if ($errors->any())
        <div class=" container alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
        </div>
    @endif
<form method="POST" action="{{ route('store.device') }}" class="container mt-5 d-flex flex-column sign-in">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Device Name</label>
        <input type="text" class="form-control" autocomplete='off' name="device_name" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="full_name" class="form-label">IP address</label>
        <input type="text" class="form-control" autocomplete='off' name="ip_address" id="full_name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Operating System</label>
        <input type="text" class="form-control"autocomplete='off' name="operating_system" id="exampleInputPassword1">
    </div>
    <select class="form-select" aria-label="Default select example" name="category_id">
    <option selected>Category</option>
    @foreach($cats as $cat)
        
        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
    @endforeach
</select>
<select class="form-select mt-3 mb-3" aria-label="Default select example"  name="depart_id">
    <option selected>Department</option>
    @foreach($departs as $depart)
        
        <option value="{{ $depart->id }}">{{ $depart->depart_name }}</option>
    @endforeach
</select>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Details</label>
        <input type="text" class="form-control" autocomplete='off' name="details" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn mt-3 btn-primary">Create</button>
</form>


@endsection