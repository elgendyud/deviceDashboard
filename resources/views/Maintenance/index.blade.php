@extends('Layouts.app')

@section('content')


<table class="table container mt-5 table-striped">
  <div class="d-flex">

    <h2 class="container mt-1">Maintenances List</h2>
    <!-- Date filter start -->
    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('index.maintenance') }}">
      <div class="form-row w-50 mb-3 d-flex justify-start container">
        <div class="col me-3">
          <label for="start_date">Start Date:</label>
          <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col me-3">
          <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
              </div>
              <div class="col mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
      </form>
    </div>
      <!-- Date filter End -->
      

  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Device</th>
      <th scope="col">Report</th>
      <th scope="col">User</th>
      <th scope="col">Date</th>
      <th scope="col">Details</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($maintenances as $index => $maintenance )
    <tr>
      <th scope="row">{{$index + 1}}</th>
      <td>{{ $maintenance->device->device_name }}</td>
      <td class="report-par"> <p style="
    max-width: 55ch;
    overflow: hidden;
    text-overflow: ellipsis; 
    white-space: nowrap; 
      "> {{ $maintenance->report }} </p> </td>
      <td>{{ $maintenance->user->username }}</td>
      <td>{{ $maintenance->created_at }}</td>
      <td><a href="{{ route('view.maintenance', $maintenance->id) }}" type="button" class="btn btn-success">View</a></td>
<td>
            <form id="deleteForm{{ $maintenance->id }}" method="POST" action="{{ route('delete.maintenance', ['id' => $maintenance->id]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete(event, 'deleteForm{{ $maintenance->id }}')">Delete</button>
            </form>
</td>

    </tr>
    @endforeach
  </tbody>


</table>
<div class="container cont-create mt-5">
  <a href="{{ route('create.maintenance') }}" 
  class="btn btn-success container m-auto">New Report</a>
</div>


<!-- Delete Maintenance -->
<script>
        function confirmDelete(event, formId) {
            event.preventDefault(); // Prevent the default form submission
            const form = document.getElementById(formId);
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        }
    </script>
        <script src="{{asset('js/sweetalert.min.js')}}"></script> 

@endsection