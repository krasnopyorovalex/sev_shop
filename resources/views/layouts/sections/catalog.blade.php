<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">
                    Категории каталога
                </div>
                <div class="sub__title">
                    Ниже представлен ассортимент продукции нашего магазина
                </div>
            </div>
        </div>
        @include('layouts.shortcodes.catalog', ['catalog' => $catalog])
    </div>
</section>
