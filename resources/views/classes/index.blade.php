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
                            <span>{{ $category['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </main>
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