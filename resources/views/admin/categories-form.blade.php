@extends('layouts.admin')

@section('content')
    <form class="admin-content__form" method="{{ isset($attributes['method']) ? $attributes['method'] : 'POST' }}" action="{{ isset($attributes['action']) ? $attributes['action'] : '' }}" enctype="multipart/form-data">
        @if(isset($attributes['second_method']))
            @method($attributes['second_method'])
        @endif
        @csrf
        <div class="admin-content__form--input">
            <label for="name">Category Name</label>
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
            <label for="">Image</label>
            <input type="file" class="" name="image" id="image" value="{{ $attributes['class']['image'] ?? old('image') }}" placeholder="">
            @if($errors->has('image'))
                <span class="invalid-feedback">{{ $errors->first('image') }}</span>
            @endif
        </div>
        <div class="admin-content__form--input">
            <label for="">Image Description</label>
            <input type="text" class="" name="image_description" id="image_description" value="{{ $attributes['class']['image_description'] ?? old('image') }}" placeholder="">
            @if($errors->has('image'))
                <span class="invalid-feedback">{{ $errors->first('image_description') }}</span>
            @endif
        </div>
    </form>
@endsection