@extends('layouts.app')

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
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.breadcrumbs', ['page' => $page])
                    <div class="seo__text">
                        {!! $page->text !!}
                    </div>
                </div>
            </div>

            @if(count($items))
            <div class="row">
                <div class="col-8">
                    <div class="cart-list">
                        @foreach($items as $item)
                            <div class="cart-list-item" data-product="{{ $item->id }}">
                                <div class="cart-list-item-image">
                                    @if($item->attributes->image)
                                        <img src="{{ $item->attributes->image }}" alt="{{ $item->name }}" />
                                    @endif
                                </div>
                                <div class="cart-list-item-name">
                                    {{ $item->name }}
                                    <span>150 г, Флоу-пак</span>
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
                                    {{ number_format($item->quantity * $item->price, 0, '.', ' ') }} <span>₽</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4">
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
                            <div class="panel-info-item-value">
                                3
                            </div>
                        </div>
                        <div class="panel-info-item">
                            <div class="panel-info-item-label">
                                Сумма заказа
                            </div>
                            <div class="panel-info-item-value">
                                <div class="total">
                                    {{ $total }} <span>₽</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

@endsection
