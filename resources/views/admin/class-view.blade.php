@extends('layouts.admin')

@section('content')
    <div class="class-view__heading" data-class-id="{{ $attributes['class']['id'] }}" id="classes-view">
        @csrf
        <div class="class-view__heading--desc">
            <h2>{{ $attributes['class']['short_description']}}</h2>
            <div class="note-edited">
                {!! $attributes['class']['description'] !!}
            </div>
        </div>
        @if($attributes['class']['image'] != '')
            <img src="{{ $attributes['class']['image'] }}" alt="">
        @endif
    </div>
    <div class="class-view__content">
        <div class="class-view__content--left">
            <div class="class-details-pane">
                <h3>Class Details</h3>
                <ul>
                    <li><strong>Category:</strong> <span>{{ $attributes['class']['category'] }}</span></li>
                    <li><strong>Status:</strong> <span class="@if($attributes['class']['status'] === 'active') active-state @else inactive-state @endif">{{ $attributes['class']['status'] }}</span></li>
                    <li><strong>Start Date:</strong> <span>{{ $attributes['class']['start_date'] }}</span></li>
                </ul>
                @if($attributes['class']['notes'] != '')
                    <div>
                        <h3>Notes</h3>
                        <div>{!! $attributes['class']['notes'] !!}</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="class-view__content--right">
            <div class="schedule-options-header">
                <h3>Class Schedules</h3>
                <span id="classesOptions"></span>
            </div>
            <div class="schedule-options-grid">
                @if(count($attributes['class']['options']) > 0)
                    @foreach($attributes['class']['options'] as $option)
                    <div class="schedule-option">
                        <h4 class="schedule-option__heading">{{ $option['day'] }}
                            <span class="edit-option" data-option-id="{{ $option['id'] }}"></span>
                        </h4>
                        <ul>
                            <li><strong>Frequency:</strong> <span>{{ $option['frequency'] }}</span></li>
                            <li><strong>Location:</strong>
                                <a href="{{ $option['venue_url'] }}" target="_blank">
                                    <span>{{ $option['venue'] }}</span>
                                </a>
                            </li>
                            <li><strong>Time:</strong> <span>{{ $option['start_time'] }} - {{ $option['end_time'] }}</span></li>
                        </ul>
                    </div>
                    @endforeach
                @else
                    <p>No schedules available for this class.</p>
                @endif
            </div>
        </div>
    </div>
@endsection