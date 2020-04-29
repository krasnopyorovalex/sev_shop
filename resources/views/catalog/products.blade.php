@extends('layouts.app')

@section('title', $catalog->title)
@section('description', $catalog->description)
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

    <main class="catalog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('page.show') }}">Главная</a>
                        </li>
                        @if($catalog->parent && $catalog->parent->parent)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $catalog->parent->parent->alias]) }}">{{ $catalog->parent->parent->name }}</a>
                            </li>
                        @endif
                        @if($catalog->parent)
                        <li>
                            <a href="{{ route('page.show', ['alias' => $catalog->parent->alias]) }}">{{ $catalog->parent->name }}</a>
                        </li>
                        @endif
                        <li>
                            {{ $catalog->name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    @include('layouts.sections.filter_panel')
                </div>
                <div class="col-10">
                    @include('layouts.partials.search-form')
                    <div class="catalog__items">
                        @foreach($products as $product)
                            <div class="catalog__items-item">
                                @if($product->image)
                                    <figure>
                                        <a href="{{ $product->url }}">
                                            <img src="{{ asset("storage/1c_catalog/{$product->image->path}") }}" alt="{{ $product->image->alt ?: $product->name }}" title="{{ $product->image->title ?: $product->name }}">
                                        </a>
                                    </figure>
                                @endif
                                <div class="catalog__items-info">
                                    <div class="name">
                                        <a href="{{ $product->url }}">{{ $product->name }}</a>
{{--                                        <span>150 г, Флоу-пак</span>--}}
                                    </div>
                                    <div class="prices">
                                        <div class="price">
                                            {{ $product->getPrice() }} <span>₽/шт.</span>
                                        </div>
                                    </div>
                                    <div class="buy">
                                        <div class="buy-more">
                                            <a href="{{ $product->url }}" class="btn">
                                                Посмотреть
                                            </a>
                                        </div>
                                        <div class="buy-submit">
                                            <button type="submit" class="btn" data-product="{{ $product->id }}">
                                                В корзину
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if($product->label)
                                    <div class="label__product {{ $product->label }}">{{ $product->getLabelName($product->label) }}</div>
                                @endif
                            </div>
                        @endforeach

                    </div>
                    <div class="pagination">
                        {{ $products->onEachSide(3)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
