@extends('layouts.app', ['map' => true])

@section('title', $page->title)
@section('description', $page->description)
@push('og')
<meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Магазин Севастополь">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')

    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    @include('layouts.sections.catalog')

    <section class="info__text">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="title">Магазин Севастополь, Симферополь</div>
                    <div class="sub__title">О компании</div>
                    <div class="text">
                        <p>Доставка продуктов питания в Севастополе.</p>
                        <p>Для вашего удобства предлагаем доставку продуктов на дом.  Предоставляем большой выбор товаров в нашем онлайн магазине. Мы быстро доставим свежее мясо и рыбу, выпечку и молочные продукты, фрукты и овощи.</p>
                        <p>Доставка в удобное для вас время по всему городу!</p>
                        <p>Доставка продуктов бесплатная при заказе от 1000 рублей.</p>
                        <p>После оформление заказа, мы перезвоним вам для уточнения. Если выбранного вами товара не оказалось в наличии или в нужном объеме, наш менеджер сообщит вам. Вы сможете найти альтернативу либо внести изменения в заказ.</p>
                        <p>По каким категориям вы можете выбрать продукты: мясо, рыба, бакалея, товары для дома, косметика, товары для детей, товары для животных, молочная продукция, вода, чипсы и снеки, консервированные продукты, товары для стирки и уборки, кондитерские изделия, соусы и приправы.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="img__bg">
                        <img src="{{ asset('img/info_text-bg.jpg') }}" alt="alt">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.begin_travel')

@endsection
