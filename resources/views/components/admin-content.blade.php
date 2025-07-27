<div class="admin-content">
    <div class="admin-content__header">
        <h1>{{ $title }}</h1>
        @if($errors->any())
            <div class="warning-message">
                <div class="message">
                    <span class="svg-icon svg-icon--warning"></span>
                    <p>Error</p>
                </div>
                <p>{{ 'Somethings not right!' }}</p>
            </div>
        @endif
        {{-- @if($success)
            <div class="success-message">
                <div class="message">
                    <span class="svg-icon svg-icon--check-circle"></span>
                    <p>Success</p>
                </div>
                <p>{{ $success }}</p>
            </div>
        @endif --}}
        <div class="admin-content__header--actions" id="admin-actions">
            @if(isset($actions))
                @foreach($actions as $key => $action)
                    <a class="jp-btn jp-btn--sm {{ $action['class'] }}" {{ isset($action['action']) ? 'href=' . $action['action'] . '' : '' }} {{ isset($action['dataset']) ? 'data-action=' . $action['dataset'] : '' }}>
                        <span class="svg-icon svg-icon--{{ $action['icon'] }}"></span>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="admin-content__content">
        {{ $slot }}
    </div>
</div>