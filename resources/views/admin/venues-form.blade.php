@extends('layouts.admin') 

@section('content')
    <form class="admin-content__form">
        <div class="admin-content__form--input">
            <label for="name">Venue Name</label>
            <input type="text" id="name" name="name" value="{{ $attributes['venue']['name'] ?? old('name') }}" class="form-control" required>
        </div>

        <div class="admin-content__form--input">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $attributes['venue']['address'] ?? old('address') }}" class="form-control" required>
        </div>
        
        <div class="admin-content__form--input">
            <label for="town">Town</label>
            <input type="text" id="town" name="town" value="{{ $attributes['venue']['town'] ?? old('town') }}" class="form-control" required>
        </div>
        
        <div class="admin-content__form--input">
            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode" value="{{ $attributes['venue']['postcode'] ?? old('postcode') }}" class="form-control" required>
        </div>

        <div class="admin-content__form--input">
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" value="{{ $attributes['venue']['capacity'] ?? old('capacity') }}" class="form-control" required>
        </div>
    </form>
@endsection