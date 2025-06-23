<nav class="admin-sidebar">
    <h2>{{ $data['heading'] }}</h2>
    <ul>
        @foreach($data['links'] as $link)
            <li>
                <span class="svg-icon svg-icon--{{ $link['icon'] }}"></span>
                <a href="" class="">
                    {{ $link['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>