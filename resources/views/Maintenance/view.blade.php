@extends('Layouts.app')

@section('content')


<div class="card container p-0 mt-5">
  <div class="card-header">
    {{ $report->device->device_name }}
  </div>
  <div class="card-body">
    <h5 class="card-title"> Maintenance Report :  {{ $report->report }}</h5>
    <p>Maintenance Date :  {{$report->created_at}} </p>
    <form id="deleteForm{{ $report->id }}" method="POST" action="{{ route('delete.maintenance', ['id' => $report->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" onclick="confirmDelete(event, 'deleteForm{{ $report->id }}')">Delete</button>
    </form>
  </div>
</div>
<div class="container mt-5">
  <h2>Installed Supplies</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Supply Name</th>
      </tr>
    </thead>
    <tbody>
      @if($report->supply)
      <tr>
        <td>{{$report->supply->supply_name}}</td>
      </tr>
      @else 
        <td>No Supplies Installed from Stock</td>
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


@endsection