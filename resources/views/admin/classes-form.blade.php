@extends('layouts.admin')

@section('content')
    <form class="admin-container__form">
        <div class="admin-container__form--input">
            <label for="name">Name</label>
            <input type="text" class="" value="" placeholder="" name="name" id="name">
        </div>
        <div class="admin-container__form--twin">
            <div>
                <div class="">
                    <label for="">Image</label>
                    <input type="file" class="" name="" id="">
                </div>
                <?php if(isset($class_image) && $class_image != ''): ?>
                    <div class="jp-image-preview">
                        <img src="" alt="" />
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <label for="">Venue</label>
                <select class="" name="" id="">
                    {{-- @foreach($category_select_options as $category)
                        <option value="$category['id'] " (isset($category_select_value)  && $category_select_value == $category['name']) ? 'selected="selected"' : '';?>></option>
                    @endforeach --}}
                </select>
            </div>
        </div>
        {{-- <div class="admin-container__form--input">
            
        </div> --}}
        <div class="admin-container__form--input">
            <label for="">Short Description</label>
            <input type="text" class="" name="" id="">
        </div>
        <div class="admin-container__form--input">
            <label for="">Description</label>
            <textarea class="jp-input" rows="20" placeholder="" name="" id=""></textarea>
        </div>
        {{-- <div class="admin-container__form--input">
            <label for=""></label>
            <textarea class="jp-input" rows="10" placeholder="" name="" id=""></textarea>
        </div> --}}
        
        <div class="admin-container__form--buttons">
            <button type="submit" id="submit-class-btn" class="jp-btn jp-btn--md jp-btn-gry">Save</button>
            <button type="clear" id="submit-class-btn" class="jp-btn jp-btn--md jp-btn-red">Cancel</button>
        </div>
    </form>
@endsection