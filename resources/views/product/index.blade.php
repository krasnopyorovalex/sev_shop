@extends('layouts.app')

@section('title', "{$product->name} | {$product->catalog->name}")
@section('description', 'В нашем магазине всегда свежие продукты. Звоните и покупайте сейчас: +7 (978) 852-79-33')
@push('og')
    <meta property="og:title" content="{{ $product->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($product->image ? $product->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $product->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('page.show') }}">Главная</a>
                        </li>
                        @isset($product->catalog->parent->parent)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->parent->parent->alias]) }}">{{ $product->catalog->parent->parent->name }}</a>
                            </li>
                        @endisset
                        @isset($product->catalog->parent)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->parent->alias]) }}">{{ $product->catalog->parent->name }}</a>
                            </li>
                        @endisset
                        @isset($product->catalog)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->alias]) }}">{{ $product->catalog->name }}</a>
                            </li>
                        @endisset
                        <li>
                            {{ $product->name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    @if($product->image)
                    <figure class="product_image">
                        <img src="{{ asset("storage/1c_catalog/{$product->image->path}") }}" alt="{{ $product->image->alt ?: $product->name }}" title="{{ $product->image->title ?: $product->name }}">
                    </figure>
                    @endif
                </div>
                <div class="col-7">
                    <div class="product__text">
                        <div class="row">
                            <div class="col-4">
                                <div class="product_price price">
                                    {{ $product->price }} <span>₽/шт.</span>
                                </div>
                                <div class="add-to-cart-box">
                                    <div class="buy">
                                        <form action="#">
                                            <div class="buy-count">
                                                <div class="buy-count-minus">-</div>
                                                <input type="text" value="1" maxlength="3">
                                                <div class="buy-count-plus">+</div>
                                            </div>
                                            <div class="buy-submit">
                                                <button type="submit" class="btn">
                                                    В корзину
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <table class="product_filters">
                                    <thead>
                                    <th colspan="2">Характеристики товара</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            2 л, Пластиковая бутылка
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Торговая марка:</td>
                                        <td>Pepsi</td>
                                    </tr>
                                    <tr>
                                        <td>Страна производитель:</td>
                                        <td>Российская Федерация</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {!! $product->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
