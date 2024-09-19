@extends('Layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert container alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('store.maintenance') }}" class="container mt-5 d-flex flex-column sign-in">
    <h2 class="text-center">New Maintenance</h2>
    @csrf


    <!-- Searchable Devices -->
    <!-- <div class="dropdown-container">
            <input type="text" id="searchInput" class="form-control" placeholder="Device Name">
            <div id="dropdownContent" class="dropdown-content"> -->
                <!-- Options will be dynamically inserted here -->
            <!-- </div>
        </div>
        <input type="hidden" id="deviceId" name="device_id"> -->
             

    <select class="form-select"  id='dropdownContent' aria-label="Default search example" name="device_id">
        <option value="" id='' disabled selected>Device Name</option>
        @foreach($devices as $device)
            <option value="{{ $device->id }}">{{ $device->device_name }}</option>
        @endforeach
        
    </select>


    <input type="hidden" value="{{ $user->id }}" name="user_id">

    <div class="form-group mt-3">
        <label for="exampleFormControlTextarea1" class="mb-3">Report</label>
        <textarea name="report" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <select class="form-select mt-2 selectpicker" id='mySelect' data-live-search="true" aria-label="Default select example" name="new_supply">
        <option value="" disabled selected>Set New Supply</option>
        @foreach($supplies as $supply)
        @if($supply->quantity > 0)
            <option value="{{ $supply->id }}">{{ $supply->supply_name}} (QTY : {{$supply->quantity}}) </option>
        @endif
        @endforeach
    </select>

    <!-- Styling of Searchable Devices-->
<style> 
        .dropdown-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            z-index: 1;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }

        .dropdown-content div {
            padding: 8px;
            cursor: pointer;
        }

        .dropdown-content div:hover {
            background-color: #f1f1f1;
        }

        .no-options {
            padding: 8px;
            color: red;
            text-align: center;
        }

        .show {
            display: block;
        }
</style>
    

<script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const dropdownContent = document.getElementById('dropdownContent');
            const deviceIdInput = document.getElementById('deviceId');

            // Convert Laravel's $devices array to JavaScript
            const devices = @json($devices);

            function populateDropdown() {
                dropdownContent.innerHTML = '';
                devices.forEach(device => {
                    const div = document.createElement('div');
                    div.textContent = device.device_name 
                    div.dataset.value = device.id;
                    div.addEventListener('click', () => {
                        searchInput.value = device.device_name;
                        deviceIdInput.value = device.id ;// Set hidden input value
                        closeDropdown();
                    });
                    dropdownContent.appendChild(div);
                });
                showNoOptionsMessage();
            }

            function showNoOptionsMessage() {
                const visibleOptions = Array.from(dropdownContent.children).filter(child => child.textContent.toLowerCase().includes(searchInput.value.toLowerCase()));
                if (visibleOptions.length === 0 && searchInput.value !== '') {
                    dropdownContent.innerHTML = '<div class="no-options">No device Found</div>';
                }
            }

            function filterOptions() {
                const filter = searchInput.value.toLowerCase();
                Array.from(dropdownContent.children).forEach(option => {
                    if (option.textContent.toLowerCase().includes(filter)) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });
                showNoOptionsMessage();
            }

            function toggleDropdown() {
                dropdownContent.classList.toggle('show');
                populateDropdown();
            }

            function closeDropdown() {
                dropdownContent.classList.remove('show');
            }

            searchInput.addEventListener('focus', toggleDropdown);
            searchInput.addEventListener('input', filterOptions);
            document.addEventListener('click', (event) => {
                if (!event.target.matches('#searchInput')) {
                    closeDropdown();
                }
            });

            // Initial population of dropdown
            populateDropdown();
        });
    </script>



<button type="submit" class="btn mt-3 btn-primary">Create</button>
</form>

<!-- Select Element be searchable -->




@endsection