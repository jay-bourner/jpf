@extends('layouts.admin')

@section('content')
    <div class="admin-content__content--list">
        @if(isset($attributes['prices']))
            @foreach($attributes['prices'] as $price)
                <div class="content-list__item">
                    <div class="content-list__item--info">
                        <div class="class-select"><input type="checkbox"></div>
                        <div class="class-name">{{ $price['price'] }}</div>
                    </div>
                    <div class="content-list__item--buttons">
                        <a href="{{ route('admin.prices.view', $price['id']) }}" class="jp-btn jp-btn--sm view-button">
                            <span class="svg-icon svg-icon--view"></span>
                        </a>
                        <a href="{{ route('admin.prices.edit', $price['id']) }}" class="jp-btn jp-btn--sm edit-button">
                            <span class="svg-icon svg-icon--pencil"></span>
                        </a>
                        <a href="{{ route('admin.prices.delete', $price['id']) }}" class="jp-btn jp-btn--sm delete-button">
                            <span class="svg-icon svg-icon--trash"></span>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection