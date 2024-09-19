@extends('Layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="d-flex w-100">
    <h2 class="container mt-1">All Purchases</h2>
    <!-- Date filter start -->
    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('purchases.index') }}">
     <div class="form-row mb-3 d-flex justify-start container">
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

    @if ($purchases->isEmpty())
        <p>No purchases found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_details }}</td>
                        <td>{{ $purchase->amount }} EGP</td>
                        <td> {{ $purchase->created_at }} </td>
                        <td>
                            <!-- Link to view purchase details -->
                            <a href="{{ route('purchases.show', ['id' => $purchase->id]) }}" class="btn btn-info">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
