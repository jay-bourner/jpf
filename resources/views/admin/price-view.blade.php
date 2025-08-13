@extends('layouts.admin')

@section('content')
    <div class="price-view__heading">
        <ul>
            <li>£{{ $attributes['price']['price'] }}
                @if($attributes['price']['type'] == 'term')
                    per {{ $attributes['price']['type'] }}
                @elseif($attributes['price']['type'] == 'payg')
                    as a {{ $attributes['price']['type'] }} service
                @endif
            </li>
            @if($attributes['price']['classes'] && $attributes['price']['period']) 
                <li>Classes: {{ $attributes['price']['classes'] }} per week for {{ $attributes['price']['period'] }}</li>
            @endif
        </ul>
    </div>
@endsection