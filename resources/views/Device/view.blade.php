@extends('Layouts.app')

@section('content')

<div class="card p-0 container mt-2">
  <div class="container  card-header">
    {{ $device->device_name }}
  </div>
  <div class="container card-body">
    <h5 class="card-title">Device IP : {{ $device->ip_address }}</h5>
    <p class="card-text"> Operating System : {{ $device->operating_system }}</p>
    <p class="card-text">Current Report : {{ $device->details }}</p>
    <p class="card-text">Created at : {{ $device->created_at }}</p>
    <p class="card-text">Last Update : {{ $device->updated_at }}</p>
    <div>
      <td><a href="{{ route('edit.device', $device->id) }}" type="button" class="btn btn-success">Update</a></td>
      <!-- <td><a href="{{ route('delete.device', $device->id) }}" type="button" class="btn btn-danger">Delete</a></td> -->
      <form id="deleteForm{{ $device->id }}" method="POST" action="{{ route('delete.device', ['id' => $device->id]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete(event, 'deleteForm{{ $device->id }}')">Delete</button>
            </form>
    </div>
  </div>

</div>


<!-- reports -->
<div class="container mt-5">
  <h2>Maintenances History</h2>
  @if($reports->isEmpty())
    <p>No maintenance records found for this device.</p>
  @else

    <table class="table">
    <thead>
      <tr>
      <th>Description</th>
      <th>Installed Supplies</th>
      <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($reports as $maintenance)
      <tr>
      <td>{{ $maintenance->report }}</td>
      <td>
      @if ($maintenance->supply)
      {{ $maintenance->supply->supply_name }}
    @else
      No Supplies
    @endif
      </td>
      <td>{{ $maintenance->created_at }}</td>
      </tr>
    @endforeach
    @endif
    </tbody>
    </table>
</div>



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
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- Display The Remain Reports from Maintenances -->


@endsection