@extends('Layouts.app')

@section('content')

@if ($errors->any())
        <div class=" container alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
        </div>
    @endif

<form method="POST" action="{{ route('update.device') }}" class="container mt-5 d-flex flex-column sign-in">
    @csrf
    <input type="hidden"  name="id" value="{{ $device->id }}">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Device Name</label>
        <input type="text" class="form-control" value="{{$device->device_name}}" name="device_name" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="ip_address" class="form-label">IP address</label>
        <input type="text" class="form-control"
         name="ip_address" id="ip_address" value="{{$device->ip_address}}" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Operating System</label>
        <input type="text" class="form-control" name="operating_system" value="{{$device->operating_system}}" id="exampleInputPassword1">
    </div>
    <select class="form-select" aria-label="Default select example" name="category_id">
    <option selected value="{{ $device->category->id }}" >{{$device->category->category_name}}</option>
    @foreach($cats as $cat)
        
        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
    @endforeach
</select>
<select class="form-select mt-3 mb-3" aria-label="Default select example"  name="depart_id">
<option selected value="{{ $device->depart->id }}" >{{$device->depart->depart_name}}</option>
    @foreach($departs as $depart)
        
        <option value="{{ $depart->id }}">{{ $depart->depart_name }}</option>
    @endforeach
</select>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Details</label>
        <input type="text" class="form-control" style="height: fit-content;" name="details" value="{{ $device->details }}" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn mt-3 btn-primary">Update</button>
</form>


@endsection 