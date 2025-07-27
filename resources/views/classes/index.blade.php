@extends('layouts.master')

@section('content')
    <div class="classes-page">
        @if(isset($data['categories']))
            <div class="classes-page__header @if(isset($no_image)) {{$no_image}} @endif">
                <div class="classes-page__header--text">
                    <h1>{{ $data['header'] }}</h1>
                    <p>{{ $data['description'] }}</p>
                </div>
            </div>
            <main class="category-list">
                <div class="category-list_filters">
                    @foreach($data['categories'] as $category)
                        <button class="category" id="{{ $category['id'] }}" data-filter="{{ $category['filter'] }}">
                            <img src="{{ $category['image'] }}" alt="{{ $category['alt'] }}" class="category-image">
                            <span class="category-name">{{ $category['name'] }}</span>
                        </button>
                    @endforeach
                </div>
                <div class="category-list_items">
                    @foreach($data['classes'] as $class)
                        <a href="{{ $class['url'] }}" class="class" id="{{ $class['id'] }}" data-filter="{{ $class['filter'] }}">
                            <span class="class-category">{{ $class['category'] }}</span>
                            <img src="{{ $class['image'] }}" alt="{{ $class['image_description'] }}" class="category-image">
                            <span class="class-name">{{ $class['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </main>
        @elseif(isset($data['class']))
            <div class="classes-page__header {{ (!$data['class']['no_image']) ? 'no_image' : '' }}">
                @if(!$data['class']['no_image'])
                    <div class="services-page__header--image">
                        <img src="{{ $data['class']['image'] }}" alt="{{ $data['class']['image_description'] }}">
                    </div>
                @endif
                <div class="classes-page__header--text">
                    <h1>{{ $data['header'] }}</h1>
                    <p>{{ $data['short_description'] }}</p>
                </div>
            </div>
            {{-- <main class="class-details">
                <h2>{{ $data['class']['header'] }}</h2>
                <p>{{ $data['class']['description'] }}</p>
                <img src="{{ $data['class']['image'] }}" alt="{{ $data['class']['image_description'] }}">
            </main> --}}
        @else
            <main class="no-services">
                <h2>Sorry, no services available at the moment.</h2>
                <p>Please check back later or <a href="/contact" style="text-decoration: underline">contact me</a> for more information.</p>
            </main>
        @endif
            
        {{-- @if(isset($data['categories']) && count($data['categories']) > 0)
            <div class="classes-page__categories">
                @foreach($data['categories'] as $category)
                    <div class="classes-page__category">
                        <h2>{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>
                    </div>
                @endforeach
            </div>
        @endif --}}
        </div>
    </div>
@endsection