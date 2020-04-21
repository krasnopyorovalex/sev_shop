<div class="box_catalog-list">
    @if(count($catalog))
    <ul>
        @foreach($catalog as $cat)
        <li>
            <a href="{{ $cat->url }}">{{ $cat->name }}</a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
