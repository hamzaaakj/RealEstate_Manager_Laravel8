@extends('layouts.app')

@section('content')
<br>

    <div class="container">
        <h2>Edit Apartment</h2>
        <form action="{{ route('apartments.update', $apartment->ApartmentsID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="ApartmentsNumber" class="form-label">Apartment Number:</label>
                <input type="text" name="ApartmentsNumber" id="ApartmentsNumber" value="{{ $apartment->ApartmentsNumber }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="SizeParSquareMeter" class="form-label">Size (sqm):</label>
                <input type="number" name="SizeParSquareMeter" id="SizeParSquareMeter" value="{{ $apartment->SizeParSquareMeter }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="PriceParSquareMeter" class="form-label">Price per sqm:</label>
                <input type="number" step="0.01" name="PriceParSquareMeter" id="PriceParSquareMeter" value="{{ $apartment->PriceParSquareMeter }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="TotalPrice" class="form-label">Total Price:</label>
                <input type="number" step="0.01" name="TotalPrice" id="TotalPrice" value="{{ $apartment->TotalPrice }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="Status" class="form-label">Status:</label>
                <select name="Status" id="Status" class="form-control">
                    <option value="Available" {{ $apartment->Status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Sold" {{ $apartment->Status == 'Sold' ? 'selected' : '' }}>Sold</option>
                    <option value="Reserved" {{ $apartment->Status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="ResidenceID" class="form-label">Residence:</label>
                <select name="ResidenceID" id="ResidenceID" class="form-control">
                    @foreach($residences as $residence)
                        <option value="{{ $residence->ResidenceID }}" {{ $apartment->ResidenceID == $residence->ResidenceID ? 'selected' : '' }}>{{ $residence->ResidenceName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeInput = document.getElementById('SizeParSquareMeter');
            const priceInput = document.getElementById('PriceParSquareMeter');
            const totalPriceInput = document.getElementById('TotalPrice');

            sizeInput.addEventListener('input', updateTotalPrice);
            priceInput.addEventListener('input', updateTotalPrice);

            function updateTotalPrice() {
                const size = parseFloat(sizeInput.value);
                const price = parseFloat(priceInput.value);
                const totalPrice = size * price;
                totalPriceInput.value = totalPrice.toFixed(2);
            }

            // Trigger the input event on page load to calculate initial Total Price
            updateTotalPrice();
        });
    </script>
@endsection
