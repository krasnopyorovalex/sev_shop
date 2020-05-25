@extends('layouts.app')

@section('title', "Доставка {$catalog->name} на дом в Севастополе | sev-product.ru")
@section('description', "Мы предлагаем вам заказать онлайн и доставить на дом товары из категории: {$catalog->name} в Севастополе. Бесплатно при заказе от 1000 р, звоните сейчас: +7 (978) 852-79-33")
@push('og')
    <meta property="og:title" content="{{ $catalog->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($catalog->image ? $catalog->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $catalog->description }}">
    <meta property="og:site_name" content="Магазин Севастополь">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($catalog->slider, 'layouts.sections.slider', ['slider' => $catalog->slider])
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $catalog->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page travels">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('page.show') }}">Главная</a>
                        </li>
                        <li>
                            <a href="{{ route('page.show', ['alias' => 'catalog']) }}">Каталог</a>
                        </li>
                        <li>
                            {{ $catalog->name }}
                        </li>
                    </ul>
                </div>
            </div>
            @include('layouts.shortcodes.catalog', ['catalog' => $catalog->catalogs])
            <div class="row">
                <div class="col-12">
                    <div class="seo__text">
                        {!! $catalog->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
