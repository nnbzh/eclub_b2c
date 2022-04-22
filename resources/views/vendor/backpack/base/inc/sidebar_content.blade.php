@foreach (\App\Helpers\AdminMenuGenerator::items() as $group)
    @php(
        $allowedItems = \App\Helpers\AdminMenuGenerator::getAllowedItems(backpack_user(),$group['items'])
    )

    @if(count($allowedItems) > 0)
        <li class="nav-title" style="font-size: 1rem;">{{ $group['label'] }}</li>
        @foreach($allowedItems as $item)
            <li class="nav-item">
                <a class="nav-link" href="{{ backpack_url($item['uri']) }}">
                    <i class="{{ $item['icon'] }}"></i>{{ $item['label'] }}
                </a>
            </li>
        @endforeach
    @endif

@endforeach
