@extends('layouts.admin')

@section('content')
    {{-- <div id="categoriesMenu"></div> --}}
    <div class="admin-content__content--list">
        @if(isset($attributes['categories']))
            @foreach($attributes['categories'] as $category)
                <div class="content-list__item">
                    <div class="content-list__item--info">
                        <div class="class-select"><input type="checkbox"></div>
                        <div class="class-name">{{ $category['name'] }}</div>
                    </div>
                    <div class="content-list__item--buttons">
                        <a href="{{ route('admin.categories.view', $category['id']) }}" class="jp-btn jp-btn--sm view-button">
                            <span class="svg-icon svg-icon--view"></span>
                        </a>
                        <a href="{{ route('admin.categories.edit', $category['id']) }}" class="jp-btn jp-btn--sm edit-button">
                            <span class="svg-icon svg-icon--pencil"></span>
                        </a>
                        <a href="{{ route('admin.categories.delete', $category['id']) }}" class="jp-btn jp-btn--sm delete-button">
                            <span class="svg-icon svg-icon--trash"></span>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection