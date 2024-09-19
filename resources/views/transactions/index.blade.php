@extends('Layouts.app')

@section('content')

    <div class="d-flex w-100">
    <h2 class="container mt-1">Credit Transactions</h2>
    <!-- Date filter start -->
    <!-- Date Filter Form -->
    <form method="GET" action="{{ route('transactions.index') }}">
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

    @if ($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->transaction_type }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
