@extends('layouts.admin') 

@section('content')
    <form class="admin-content__form"  method="{{ isset($attributes['method']) ? $attributes['method'] : 'POST' }}" action="{{ isset($attributes['action']) ? $attributes['action'] : '' }}" enctype="multipart/form-data">
        @csrf
        <div class="admin-content__form--input">
            <label for="price">Price Name</label>
            <input type="text" id="price" name="price" value="{{ $attributes['price']['price'] ?? old('price') }}" class="form-control" required>
            @if($errors->has('price'))
                <span class="invalid-feedback">{{ $errors->first('price') }}</span>
            @endif
        </div>

        <div class="admin-content__form--input">
            <label for="address">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="payg" {{ ($attributes['price']['type'] ?? old('type')) == 'payg' ? 'selected' : '' }}>Pay As You Go</option>
                <option value="term" {{ ($attributes['price']['type'] ?? old('type')) == 'term' ? 'selected' : '' }}>Term</option>
            </select>
            @if($errors->has('type'))
                <span class="invalid-feedback">{{ $errors->first('type') }}</span>
            @endif
        </div>
        
        <div class="admin-content__form--input">
            <label for="amount">Amount of Classes</label>
            <input type="text" id="amount" name="amount" value="{{ isset($attributes['price']['amount']) ? $attributes['price']['amount'] : old('amount') }}" class="form-control" {{ isset($attributes['price']['type']) && $attributes['price']['type'] == 'payg' ? 'disabled' : 'required' }}>
        </div>
            @if($errors->has('amount'))
                <span class="invalid-feedback">{{ $errors->first('amount') }}</span>
            @endif
        
        <div class="admin-content__form--input">
            <label for="period">Period</label>
            <select name="period" id="period" class="form-control" {{ isset($attributes['price']['type']) && $attributes['price']['type'] == 'payg' ? 'disabled' : 'required' }}>
                <option value="6 Weeks" {{ ($attributes['price']['period'] ?? old('period')) == '6 Weeks' ? 'selected' : '' }}>6 Weeks</option>
            </select>
            @if($errors->has('period'))
                <span class="invalid-feedback">{{ $errors->first('period') }}</span>
            @endif
        </div>

        {{-- <div class="admin-content__form--input">
            <label for="capacity">Notes</label>
            <textarea name="capacity" id="capacity" class="form-control">{{ $attributes['price']['capacity'] ?? old('capacity') }}</textarea>
        </div> --}}
    </form>
@endsection