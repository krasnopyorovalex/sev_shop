<div class="panel-info">
    <div class="panel-info-item">
        <div class="panel-info-item-label">
            Минимальная сумма заказа
        </div>
        <div class="panel-info-item-value">
            1 000 ₽
        </div>
    </div>
    <div class="panel-info-item">
        <div class="panel-info-item-label">
            Товаров
        </div>
        <div class="panel-info-item-value cart-list-item-quantity">
            {{ $quantity }}
        </div>
    </div>
    <div class="panel-info-item">
        <div class="panel-info-item-label">
            Сумма заказа
        </div>
        <div class="panel-info-item-value">
            <div class="total">
                <div class="total-value">{{ number_format($total, 0, '.', ' ') }}</div>
                <span>₽</span>
            </div>
        </div>
    </div>
</div>
