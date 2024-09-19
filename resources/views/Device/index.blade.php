@extends('Layouts.app')

@section('content')
<div class="d-flex container">

  <h2 class="container mt-1">Devices List</h2>
  <form action="{{ route('index.device') }}" class="form" method="GET">
    <input style="width: 500px;" class="form-control" type="text" autocomplete='off' name="search" placeholder="Search With IP Address" value="{{ request('search') }}">
    <!-- <button class="btn btn-primary" type="submit">Search</button> -->
  </form>
</div>
<table class="table table-striped container mt-5">
<!-- Search Start -->
<!-- Search End -->

  <thead>
    <tr>
      <th scope="col">No.</th>
      <th class="th" style='cursor: pointer' onclick="tablesort()" scope="col">Device Name
        <i class="bx bx-sort sort"></i>
      </th>
      <th class="th" style='cursor: pointer'  onclick="tablesort()" scope="col">ip address
        <i class="bx bx-sort sort"></i>
        
      </th>
      <th class="th" style='cursor: pointer'  onclick="tablesort()" scope="col">Operating System
        <i class="bx bx-sort sort"></i>
        
      </th>
      <th class="th" style='cursor: pointer'  onclick="tablesort()" scope="col">Category
        <i class="bx bx-sort sort"></i>
        
      </th>
      <th class="th" style='cursor: pointer'  onclick="tablesort()" scope="col">Depart
        <i class="bx bx-sort sort"></i>

      </th>
      <th scope="col">Update</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>

    <!-- Update start -->
    <div class="container mt-3">
      <div class="w-100 text-center">

        <a href="{{ route('index.device') }}" class="btn btn-secondary {{ !$categoryId ? 'btn-success' : '' }}">Show All</a>
        
        @foreach($categories as $category)
        <a href="{{ route('index.device', ['category_id' => $category->id]) }}"
        class="btn btn-secondary m-1 {{ $categoryId == $category->id ? 'btn-success' : '' }}">
        {{ $category->category_name }} 
      </a>
      @endforeach
    </div>
    <!-- Create New Device -->
      <div class="container mt-3">
        <a href="{{ route('create.device') }}" class="btn btn-success container m-auto"> Create New Device </a>
      </div>
    </div>
    <!-- Update end -->
    @if($searches)
    
    @foreach ($searches as $index => $device)
    <tr>
      <!--  Sorting Buttons -->

      <th scope="row">{{$index + 1}}</th>
      <td>{{ $device->device_name }}</td>
      <td>{{ $device->ip_address }}</td>
      <td>{{ $device->operating_system }}</td>
      <td>{{ $device->category->category_name }}</td>
      <td>{{ $device->depart->depart_name }}</td>
      <td><a href="{{ route('edit.device', $device->id) }}" type="button" class="btn btn-success">Update</a></td>
      <td><a href="{{ route('view.device', $device->id) }}" type="button" class="btn btn-success">View</a></td>


    </tr>
    @endforeach
    @else
    @foreach ($devices as $index => $device)
    <tr>
      <!--  Sorting Buttons -->

      <th scope="row">{{$index + 1}}</th>
      <td>{{ $device->device_name }}</td>
      <td>{{ $device->ip_address }}</td>
      <td>{{ $device->operating_system }}</td>
      <td>{{ $device->category->category_name }}</td>
      <td>{{ $device->depart->depart_name }}</td>
      <td><a href="{{ route('edit.device', $device->id) }}" type="button" class="btn btn-success">Update</a></td>
      <td><a href="{{ route('view.device', $device->id) }}" type="button" class="btn btn-success">View</a></td>


    </tr>

  @endforeach
@endif

  </tbody>


</table>

<script src="{{ asset('js/tablesort.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableHeaders = document.querySelectorAll('.th');  // Select all the <th> elements

        tableHeaders.forEach(th => {
            th.addEventListener('click', function() {
                // Hide all icons first
                document.querySelectorAll('.sort').forEach(icon => icon.style.display = 'none');
                
                // Display the icon inside the clicked table header
                const icon = th.querySelector('.sort');
                if (icon) {
                    icon.style.display = 'inline-block';  // Make the icon visible
                }
            });
        });
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    new Tablesort(document.querySelector('table'));
});
  </script>


@endsection