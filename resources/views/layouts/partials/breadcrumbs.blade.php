<ul class="breadcrumbs">
    <li>
        <a href="{{ route('page.show') }}">Главная</a>
    </li>
    @if (isset($parent))
        <li>
            <a href="{{ route('page.show', ['alias' => $parent->alias]) }}">{{ $parent->name }}</a>
        </li>
    @endif
    <li>
        {{ $page->name }}
    </li>
</ul>
