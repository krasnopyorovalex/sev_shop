@if(count($catalog))
<div class="left-category-menu">
    <ul class="not__decorated">
        @foreach($catalog as $catalogItem)
        <li class="{{ is_current($catalogItem) ? 'current' : '' }}">
            <a href="{{ $catalogItem->url }}" class="{{ is_current($catalogItem) ? 'active' : '' }}">{{ $catalogItem->name }}</a>
            <span class="icon-down">
                {{ svg('icon-cheveron-down') }}
            </span>
            @if(count($catalogItem->catalogs))
            <ul class="not__decorated">
                @foreach($catalogItem->catalogs as $catalogChild)
                <li><a href="{{ $catalogChild->url }}">- {{ $catalogChild->name }}</a></li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endif
