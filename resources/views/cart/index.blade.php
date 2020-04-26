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
                        @include('cart.sections.cart-list')
                    </div>
                    <div class="col-4">
                        @include('cart.sections.panel-info')
                    </div>
                </div>
                @include('cart.sections.form-order')
            @endif
        </div>
    </main>

@endsection
