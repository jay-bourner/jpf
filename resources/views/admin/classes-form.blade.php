@extends('layouts.admin')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="admin-content__form" method="{{ isset($attributes['method']) ? $attributes['method'] : 'POST' }}" action="{{ isset($attributes['action']) ? $attributes['action'] : '' }}" enctype="multipart/form-data">
        @csrf
        <div class="admin-content__form--input">
            <label for="name">Class Name</label>
            <input type="text" class="" value="{{ $attributes['class']['name'] ?? old('name') }}" placeholder="" name="name" id="name">
        </div>
        <div class="admin-content__form--input">
            <label for="">Image</label>
            <input type="file" class="" name="" id="">
            {{-- @if(isset($class_image) && $class_image != '')
                <div class="jp-image-preview">
                    <img src="" alt="" />
                </div>
            @endif --}}
        <div>
        <div class="admin-content__form--input">
            <label for="">Image Description</label>
            <input type="text" class="" name="image_description" id="image_description" value="{{ $attributes['class']['image_description'] ?? old('image_description') }}">
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
        <div class="admin-content__form--input">
            <label for="">Short Description</label>
            <input type="text" class="" name="short_description" id="short_description" value="{{ $attributes['class']['short_description'] ?? old('short_description') }}" placeholder="">
        </div>
        <div class="admin-content__form--input">
            <label for="">Description</label>
            <textarea class="jp-input" rows="20" placeholder="" name="description" id="description">{{ $attributes['class']['description'] ?? old('description') }}</textarea>
        </div>
        <div class="admin-content__form--input">
            <label for="">Start Date</label>
            <input type="date" class="" name="start_date" id="start_date" value="{{ $attributes['class']['start_date'] ?? old('start_date') }}" placeholder="YYYY-MM-DD">
        </div>
        <div class="admin-content__form--input">
            <label for="">Notes</label>
            <textarea class="jp-input" rows="20" placeholder="" name="notes" id="notes">{{ $attributes['class']['notes'] ?? old('notes') }}</textarea>
        </div>
    </form>
@endsection