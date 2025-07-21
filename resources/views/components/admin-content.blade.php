<div class="admin-content">
    <div class="admin-content__header">
        <h1>{{ $title }}</h1>
        <div class="admin-content__header--actions">
            @if(isset($actions))
                @foreach($actions as $key => $action)
                    <button class="{{ $action['class'] }}">
                        {{-- <span class="svg-icon svg-icon--{{ $action['icon'] }}"></span> --}}
                        {{ $action['label'] }}
                    </button>
                @endforeach
            @endif
        </div>
    </div>

    <div class="admin-content__content">
        <div class="admin-content__content--list">
            {{ $slot }}
        </div>
    </div>
</div>