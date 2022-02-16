@foreach (\App\Helpers\AdminMenuGenerator::items() as $item)
    <li class="nav-item">
        <a class="nav-link" href="{{ $item['route'] }}">
            <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
        </a>
    </li>
@endforeach
