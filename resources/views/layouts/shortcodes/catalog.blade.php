<div class="row">
    <div class="col-12">
        <div class="categories-box">
            @foreach ($catalog as $cat)
                <div class="categories-item">
                    @if ($cat->image)
                        <a href="{{ $cat->url }}">
                            <img src="{{ $cat->image->path }}" alt="{{ $cat->image->alt }}" title="{{ $cat->image->title }}">
                        </a>
                    @endif
                    <div class="categories-item-name">
                        <a href="{{ $cat->url }}">{{ $cat->name }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
