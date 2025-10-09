<footer {{ $attributes->merge(['class' => ($data['footer_class'] ?? '')]) }}>
    <div class="footer-grid">
        @foreach($footer['columns'] as $column)
            <div class="{{ (isset($column['class'])) ? $column['class'] : '' }}">
                @if(isset($column['header']))
                    <div class="links-header">
                        <h3>{{ $column['header'] }}</h3>
                    </div>
                @endif
                <nav>
                    @foreach($column['links'] as $link)
                        <div>
                            @if (isset($link['name']))
                                <a href="{{ $link['href'] }}">{{ $link['name'] }}</a>
                            @elseif (isset($link['email']))
                                Email: <a href="mailto:{{ $link['email'] }}">{{ $link['email'] }}</a>
                            @elseif (isset($link['tel']))
                                Tel: <a href="tel:{{ $link['tel'] }}">{{ $link['tel'] }}</a>
                            @elseif (isset($link['icon']))
                                <a href="{{ $link['href'] }}" target="_blank">
                                    <span class="svg-icon svg-icon--{{ $link['icon'] }}"></span>
                                </a>
                            @elseif (isset($link['sprintf']) && isset($link['link']))
                                {!! sprintf($link['sprintf'], $link['link']) !!} 
                            @elseif (isset($link['text']))
                                {!! $link['text'] !!} 
                            @endif
                        </div>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>
</footer>