@extends('Layouts.app')

@section('content')
    <h2>Purchase Details</h2>

    <p><strong>Purchase Details:</strong> {{ $purchase->purchase_details }}</p>
    <p><strong>Total Amount:</strong> {{ $purchase->amount }}</p>
    <p><strong>Date:</strong> {{ $purchase->created_at }}</p>


    <h3>Supplies</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Supply Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->supplies as $supply)
                <tr>
                    <td>{{ $supply->supply_name }}</td>
                    <td>{{ $supply->price }}</td>
                    <td>{{ $supply->quantity }}</td>
                    <td>{{ $supply->price * $supply->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
