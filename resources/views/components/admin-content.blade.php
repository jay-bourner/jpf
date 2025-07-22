<div class="admin-content">
    <div class="admin-content__header">
        <h1>{{ $title }}</h1>
        <div class="admin-content__header--actions">
            @if(isset($actions))
                @foreach($actions as $key => $action)
                    <a class="jp-btn jp-btn--sm {{ $action['class'] }}" href="{{ $action['action'] }}">
                        {{-- Uncomment the line below if you want to include tooltips --}}
                        {{-- <span class="tooltip">{{ $action['tooltip'] }}</span> --}}
                        {{-- Uncomment the line below if you want to include icons --}}
                        <span class="svg-icon svg-icon--{{ $action['icon'] }}"></span>
                        {{-- {{ $action['label'] }} --}}
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="admin-content__content">
        {{ $slot }}
    </div>
</div>