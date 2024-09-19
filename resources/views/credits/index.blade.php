@extends('Layouts.app')

@section('content')
<!-- Create new Credit -->
<!-- Add credit to Database -->
<!-- Graphs for credit and purchaese -->
<!-- Create New purchaese -->
<!-- Total purchaeses -->

<!-- Credit has two row [ income, outcome ] -->

<div class="d-flex">

    <div class="credit">
        <form class="add-credit" action="{{ route('credits.add') }}" method="POST">
            <h2>Available Credit</h2>
            <p>Current Available Credit: <strong>{{ $available_credit }} EGP</strong></p>
            @csrf
            <div class="form-group mb-3">
                <input type="number" placeholder="add New Credit" name="amount" id="amount" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-outline-dark">
                <i class='bx bx-add-to-queue nav_icon'></i>
                Add Credit</button>
        </form>
        <a class="btn btn-dark mt-2" href="{{ route('transactions.index') }}">View Transactions History</a>
        <hr>
    </div>
    <div class="right-credit">
        <h2 class="mb-3">Purchases</h2>
        <a href="{{ route('purchases.create') }}" class="btn btn-outline-dark">
            <i class='bx bx-cart-add nav_icon'></i>
            New Purchase</a>
        <a href="{{ route('purchases.index') }}" class="btn btn-dark">
            View Purchases History</a>
    </div>
</div>
<div>
    <h2 class="mb-3">Available Stock</h2>
        <a href="{{ route('stock.index') }}" class="btn btn-dark">
            View Available Stock</a>
</div>





@if(Session::has('Fail'))
    <div class="alert alert-danger container m-5" style="text-align: center; width: 75%">
        {{ Session::get('Fail') }}
    </div>

@endif
@endsection