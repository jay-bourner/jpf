<div class="banner">
    <div class="heading">
        <div class="desktop-nav">
            <div class="tag-line">
                <h1>{{ $header['tagline'] }} </h1>
            </div>
            <nav>
                <ul>
                    @foreach($header['navigation'] as $nav)
                        <li><a href="{{ $nav['href'] }}">{{ $nav['name'] }}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    
    <div class="mobile-nav">
        <div class="mobile-nav-btn" id="mobile-nav-btn">
            <div class="line top-line"></div>
            <div class="line middle-line"></div>
            <div class="line bottom-line"></div>
        </div>
        <div class="mobile-nav-links">
            @foreach($header['navigation'] as $nav)
                <div><a href="{{ $nav['href'] }}">{{ $nav['name'] }}</a></div>
            @endforeach
        </div>
    </div>
</div>