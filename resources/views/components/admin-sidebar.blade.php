<nav class="admin-sidebar">
    <h2>{{ $data['heading'] }}</h2>
    <ul>
        @foreach($data['links'] as $link)
            <li @if(isset($link['dropdown'])) class="has-dropdown" @endif>
                <span class="svg-icon svg-icon--{{ $link['icon'] }}"></span>
                @if(isset($link['dropdown']))
                <div class="admin-sidebar__dropdown--container">
                    <div class="admin-sidebar__dropdown--heading">
                        <span>{{$link['name'] }}</span>
                        <span class="svg-icon svg-icon--caret-right"></span>
                    </div>
                    <div class="admin-sidebar__dropdown--list">
                        <ul>
                            @foreach($link['dropdown'] as $sublink)
                                <li class="admin-sidebar__dropdown--list-item">
                                    <a href="{{ $sublink['href'] }}" class="">
                                        {{ $sublink['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <a href="{{ $link['href'] }}" class="">
                    {{ $link['name'] }}
                </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>