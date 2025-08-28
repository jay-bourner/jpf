@extends('layouts.master')

@section('content')
        <div class="mid-section">
        @foreach($data['mission_cards'] as $card)
            <div class="mid-element mid-element-{{ $card['class'] }}">
                <h2>{{ $card['title'] }}</h2>
                <p>{{ $card['description'] }}</p>
                @if(isset($card['list']))
                    <ul>
                        @foreach($card['list'] as $list)
                            <li>{{ $list }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>

    <div class="intro-section">
        <div class="intro-section-inner">
            @foreach($data['intro'] as $class)
                @foreach($class as $key => $value)
                    <div class="intro-element-{{ $key }}">
                        @if(isset($value['image']))
                            <div class="left-column-image">
                                <img src="{{ $value['image'] }}" alt="{{ $value['alt'] }}" width="500" height="500">
                                <svg viewBox="0 0 3189 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
                                    <g transform="matrix(2.03592,0.0366734,-0.0742454,4.12173,-460.181,-3104.7)">
                                        <path d="M267.03,829.976C422.362,815.476 749.537,769.178 997.731,780.288C1698.57,811.661 1817.06,710.168 1808.48,762.287C1808.44,762.552 1808.41,762.818 1808.41,763.084C1808.41,768.05 1808.41,817.158 1808.41,817.158L267.03,829.976Z" />
                                    </g>
                                </svg>
                            </div>
                        @endif
                        @if(isset($value['header']))
                            <div class="intro-left-header">
                                <h2>{{ $value['header'] }}</h2>
                            </div>
                        @endif
                        @if(isset($value['paragraphs']))
                            @foreach($value['paragraphs'] as $paragraph)
                                <div class="intro-left-content">
                                    <p>{!! $paragraph !!}</p>
                                </div>
                            @endforeach
                        @endif
                        @if(isset($value['list']))
                            <div class="{{ $value['class'] }}">
                                @foreach($value['list'] as $list)
                                    <div class="class-list-text">{{ $list }}</div>
                                    <svg class="divider" viewBox="0 0 576 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                        <g transform="matrix(1,0,0,1,-224.226,-368)">
                                            <g transform="matrix(3.03763,0,0,3.03763,-875.717,-746.39)">
                                                <circle cx="456.842" cy="372.129" r="5.267" />
                                            </g>
                                            <g transform="matrix(6.12323e-17,1,-1,6.12323e-17,1183.77,268.591)">
                                                <path d="M115.409,384L121.858,671.774L108.959,671.774L115.409,384Z" />
                                            </g>
                                            <g transform="matrix(-6.12323e-17,1,1,6.12323e-17,-159.774,268.591)">
                                                <path d="M115.409,384L121.858,671.774L108.959,671.774L115.409,384Z" />
                                            </g>
                                        </g>
                                    </svg>
                                @endforeach
                            </div>
                        @endif
                        @if(isset($value['price']))
                            <div class="price-tag">
                                <img src="image/icons/new-star.png" alt="">
                                <div class="price-item">
                                    <span>£{{ $value['price'] }}</span>
                                    <span>per session</span>
                                    <span>
                                        <p>Please ask for term prices.</p>
                                        <p>Each term is 6 weeks </p>
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if(isset($value['button']))
                            <div class="cta-button">
                                <a class="jp-btn jp-btn--md jp-btn-grn" href="{{ $value['button']['link'] }}">{{ $value['button']['text'] }}</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="testimonials">
        @foreach($data['testimonials'] as $testimonial)
            <h2>{{ $testimonial['header'] }}</h2>
            <p>{{ $testimonial['sub_header'] }}</p>
            <div class="quotes">
                @foreach($testimonial['quotes'] as $quote)
                    <div class="quote">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M0 216C0 149.7 53.7 96 120 96l8 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-8 0c-30.9 0-56 25.1-56 56l0 8 64 0c35.3 0 64 28.7 64 64l0 64c0 35.3-28.7 64-64 64l-64 0c-35.3 0-64-28.7-64-64l0-32 0-32 0-72zm256 0c0-66.3 53.7-120 120-120l8 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-8 0c-30.9 0-56 25.1-56 56l0 8 64 0c35.3 0 64 28.7 64 64l0 64c0 35.3-28.7 64-64 64l-64 0c-35.3 0-64-28.7-64-64l0-32 0-32 0-72z"/>
                        </svg>
                        @foreach($quote['quote'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                        <span> - {{ $quote['author'] }}</span>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="home-images-container">
        <h2>{{ $data['images_section']['header'] }}</h2>
        <p>{{ $data['images_section']['sub_header'] }}</p>
        <div class="home-images">
            @foreach($data['images_section']['images'] as $key => $image)
                <div class="image-box image-box--{{ $key }}">
                    <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}">
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="qualifications-container">
        <div class="qualification-content">
            <div class="text">
                <h2>{{ $data['qualifications']['header'] }}</h2>
                @foreach($data['qualifications']['text_content'] as $paragraph)
                    <p>{{ $paragraph['para'] }}</p>
                    <ul>
                        @foreach($paragraph['list'] as $list)
                            <li>{{ $list }}</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            <div class="qualifications">
                @foreach($data['qualifications']['images'] as $image)
                    <div class="qualification">
                        <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" wwidth="700" height="600">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection