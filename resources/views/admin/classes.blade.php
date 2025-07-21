@extends('layouts.admin')

@section('content')
    @if(isset($attributes['classes']))
        @foreach($attributes['classes'] as $class)
            <div class="content-list__item">
                <div class="content-list__item--info">
                    <div class="class-select"><input type="checkbox"></div>
                    <div class="class-name">{{ $class['name'] }}</div>
                </div>
                <div class="content-list__item--buttons">
                    <a class="jp-btn jp-btn--sm edit-button">
                        <span class="svg-icon svg-icon--pencil"></span>
                    </a>
                    <a class="jp-btn jp-btn--sm delete-button">
                        <span class="svg-icon svg-icon--trash"></span>
                    </a>
                </div>
            </div>
        @endforeach
    @endif
@endsection