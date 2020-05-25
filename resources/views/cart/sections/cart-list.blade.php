<div class="cart-list">
    @foreach($items as $item)
        <div class="cart-list-item" data-product="{{ $item->id }}">
            <div class="cart-list-item-image">
                <img src="{{ $item->image ? asset("storage/1c_catalog/{$item->image}") : asset('img/default-product.png') }}">
            </div>
            <div class="cart-list-item-name">
                {{ $item->name }}
{{--                <span>150 г, Флоу-пак</span>--}}
            </div>
            <div class="cart-list-item-single">
                {{ number_format($item->price, 0, '.', ' ') }} <span>₽/шт.</span>
            </div>
            <div class="cart-list-item-quantity">
                <div class="buy">
                    <form action="#">
                        <div class="buy-count">
                            <div class="buy-count-minus">-</div>
                            <input type="text" value="{{ $item->quantity }}" maxlength="3">
                            <div class="buy-count-plus">+</div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="cart-list-item-remove">
                <div class="btn-remove" title="Удалить товар" data-product="{{ $item->id }}">
                    {{ svg('icon-trash') }}
                </div>
            </div>
            <div class="cart-list-item-sum">
                <div class="value">{{ number_format($item->quantity * $item->price, 0, '.', ' ') }}</div>
                <span>₽</span>
            </div>
        </div>
    @endforeach
</div>
