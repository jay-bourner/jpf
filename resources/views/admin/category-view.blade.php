@extends('layouts.admin')

@section('content')
    <div class="class-view__heading" data-class-id="{{ $attributes['category']['id'] }}">
        @csrf
        <div class="class-view__heading--desc">
            {{-- <h2>{{ $attributes['category']['name']}}</h2> --}}
            <div>
                @if($attributes['category']['short_description'] != '')
                    {!! $attributes['category']['short_description'] !!}
                @else
                    No description available.
                @endif
            </div>
        </div>
        @if($attributes['category']['image'] != '')
            <img src="{{ $attributes['category']['image'] }}" alt="">
        @endif
    </div>
@endsection