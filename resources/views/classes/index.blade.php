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
                        <a href="{{ $class['url'] }}" class="class-link" id="{{ $class['id'] }}" data-filter="{{ $class['filter'] }}">
                            <div class="class-image-container">
                                <img src="{{ $class['image'] }}" alt="{{ $class['image_description'] }}" class="category-image">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 100'>
                                    <g>
                                        <path d='M0 0v99.7C62 69 122.4 48.7 205 66c83.8 17.6 160.5 20.4 240-12 54-22 110-26 173-10a392.2 392.2 0 0 0 222-5c55-17 110.3-36.9 160-27.2V0H0Z' opacity='.5'></path>
                                        <path d='M0 0v74.7C62 44 122.4 28.7 205 46c83.8 17.6 160.5 25.4 240-7 54-22 110-21 173-5 76.5 19.4 146.5 23.3 222 0 55-17 110.3-31.9 160-22.2V0H0Z'></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="class-text-container">
                                <h2>{{ $class['name'] }}</h2>
                                <p>{!! $class['short_description'] !!}</p>
                            </div>
                            
                            {{-- <span class="class-category">{{ $class['category'] }}</span> --}}
                            
                            
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