@extends('Layouts.app')

@section('content')
@if ($stocks->isEmpty())
    <p>No Available Stocks.</p>
@else
    <table class="table">
        <h2>Available Stock</h2>
        <thead>
            <tr>
                <th>Supply Name</th>
                <th>Quantity</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
            @if($stock->quantity > 0)
                <tr>
                    <td>{{ $stock->supply_name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td> {{ $stock->updated_at }} </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endif

@endsection