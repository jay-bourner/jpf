@extends('layouts.admin') 

@section('content')
    <form class="admin-content__form">
        <div class="admin-content__form--input">
            <label for="price">Price Name</label>
            <input type="text" id="price" name="price" value="{{ $attributes['price']['price'] ?? old('price') }}" class="form-control" required>
        </div>

        <div class="admin-content__form--input">
            <label for="address">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="payg" {{ ($attributes['price']['type'] ?? old('type')) == 'payg' ? 'selected' : '' }}>Pay As You Go</option>
                <option value="term" {{ ($attributes['price']['type'] ?? old('type')) == 'term' ? 'selected' : '' }}>Term</option>
            </select>
        </div>
        
        <div class="admin-content__form--input">
            <label for="town">Amount of Classes</label>
            <input type="text" id="town" name="town" value="{{ $attributes['price']['town'] ?? old('town') }}" class="form-control" {{ ($attributes['price']['type'] == 'payg') ? 'disabled' : 'required' }}>
        </div>
        
        <div class="admin-content__form--input">
            <label for="postcode">Period</label>
            <select name="period" id="period" class="form-control" {{ ($attributes['price']['type'] == 'payg') ? 'disabled' : 'required' }}>
                <option value="6 Weeks" {{ ($attributes['price']['period'] ?? old('period')) == '6 Weeks' ? 'selected' : '' }}>6 Weeks</option>
            </select>
        </div>

        <div class="admin-content__form--input">
            <label for="capacity">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ $attributes['price']['notes'] ?? old('notes') }}</textarea>
        </div>
    </form>
@endsection