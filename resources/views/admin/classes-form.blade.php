@extends('layouts.admin')

@section('content')
    <form class="admin-content__form" method="{{ isset($attributes['method']) ? $attributes['method'] : 'POST' }}" action="{{ isset($attributes['action']) ? $attributes['action'] : '' }}" enctype="multipart/form-data">
        @if(isset($attributes['second_method']))
            @method($attributes['second_method'])
        @endif
        @csrf
        <div class="admin-content__form--input">
            <label for="name">Class Name</label>
            <input type="text" class="" value="{{ isset($attributes['class']['name']) ? $attributes['class']['name'] : old('name') }}" placeholder="" name="name" id="name">
            @if($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') ?? $warning }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Short Description</label>
            <input type="text" class="" name="short_description" id="short_description" value="{{ $attributes['class']['short_description'] ?? old('short_description') }}" placeholder="">
            @if($errors->has('short_description'))
                <span class="invalid-feedback">{{ $errors->first('short_description') }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Description</label>
            <textarea class="jp-input summernote" rows="20" placeholder="" name="description" id="description">{{ $attributes['class']['description'] ?? old('description') }}</textarea>
            @if($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Start Date <small>(for instant start, leave blank)</small></label>
            <input type="date" class="" name="start_date" id="start_date" value="{{ $attributes['class']['start_date'] ?? old('start_date') }}" placeholder="YYYY-MM-DD">
            @if($errors->has('start_date'))
                <span class="invalid-feedback">{{ $errors->first('start_date') }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Image</label>
            <input type="file" class="" name="image" id="image">
            @if(isset($class_image) && $class_image != '')
                <div class="jp-image-preview">
                    <img src="" alt="" />
                </div>
            @endif
            @if($errors->has('image'))
                <span class="invalid-feedback">{{ $errors->first('image') }}</span>
            @endif
        <div>
        <div class="admin-content__form--input">
            <label for="">Image Description</label>
            <input type="text" class="" name="image_description" id="image_description" value="{{ $attributes['class']['image_description'] ?? old('image_description') }}">
            @if($errors->has('image_description'))
                <span class="invalid-feedback">{{ $errors->first('image_description') }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Category</label>
            @if(!empty($attributes['categories']))
                <select class="" name="category_id" id="category_id">
                    @foreach($attributes['categories'] as $category)
                        <option value="{{ $category['id'] }}" {{ (isset($attributes['class']['category_id']) && $attributes['class']['category_id'] == $category['id']) ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <p>No categories available.</p>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Venue</label>
            @if(!empty($attributes['venues']))
                <select class="" name="venue_id" id="venue_id">
                    @foreach($attributes['venues'] as $venue)
                        <option value="{{ $venue['id'] }}" {{ (isset($attributes['class']['venue_id']) && $attributes['class']['venue_id'] == $venue['id']) ? 'selected' : '' }}>
                            {{ $venue['name'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <p>No venues available.</p>
            @endif
        </div>
        {{-- <div class="admin-content__form--input">
            <label for="">Title</label>
            <input type="text" class="" name="title" id="title" value="{{ $attributes['class']['title'] ?? old('title') }}" placeholder="">
        </div> --}}
        {{-- <div class="admin-content__form--input">
            <label for="">Notes</label>
            <textarea class="jp-input" rows="20" placeholder="" name="notes" id="notes">{{ $attributes['class']['notes'] ?? old('notes') }}</textarea>
            @if($errors->has('notes'))
                <span class="invalid-feedback">{{ $errors->first('notes') }}</span>
            @endif
        </div> --}}
    </form>
@endsection