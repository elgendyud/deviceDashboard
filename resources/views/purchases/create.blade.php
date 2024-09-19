@extends('Layouts.app')

@section('content')
<div style="width: 100%;">
@if ($errors->any())
        <div class=" container alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
        </div>
    @endif
    <h2>Make a Purchase</h2>

    <form class="mt-3" action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="purchase_details">Purchase Details:</label>
            <input type="text" name="purchase_details" autocomplete='off' id="purchase_details" style='width:80%' class="form-control" required>
        </div>

        <h3 class="mt-4 mb-2">Supplies</h3>
        <div class="mb-4" id="supplies-list">
            <div class="supply-item mb-3">
                <div class="form-group w-100">
                    <label for="supply_name[]">Supply Name:</label>
                    <input  type="text" name="supply_name[]" autocomplete='off' class="form-control w-50" required>
                </div>

    <div class='d-flex mt-1 w-100'>
        <div class="form-group me-1">
            <label for="price[]">Price:</label>
            <input type="number"  step="0.01" name="price[]" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="quantity[]">Quantity:</label>
            <input type="number"  name="quantity[]" class="form-control" required>
        </div>
    </div>

            </div>
        </div>

        <button type="button" id="add-supply" class="btn btn-secondary">Add Another Supply</button>

        <button type="submit" class="btn btn-primary">Submit Purchase</button>
    </form>
    @if(Session::has('Fail'))
        <div class="alert alert-danger container m-5" style="text-align: center; width: 75%">
            {{ Session::get('Fail') }}
        </div>
    @endif
</div>
<script>
    document.getElementById('add-supply').addEventListener('click', function () {
        const suppliesList = document.getElementById('supplies-list');
        const supplyItem = document.querySelector('.supply-item').cloneNode(true);
        suppliesList.appendChild(supplyItem);
    });
</script>
@endsection