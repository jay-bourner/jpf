@extends('layouts.admin')

@section('content')
    <div class="venue-view__address">
        <ul>
            <li>{{ $attributes['venue']['name'] }}</li>
            <li>{{ $attributes['venue']['address'] }}</li>
            <li>{{ $attributes['venue']['town'] }}</li>
            <li>{{ $attributes['venue']['postcode'] }}</li>
            <li>Capacity: {{ $attributes['venue']['capacity'] }}</li>
        </ul>
    </div>
@endsection