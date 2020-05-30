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
    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])
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
        </div>
    </main>
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aa2a51c95381d496f915fa1519acc981fa44877e93fe799118c1117ec664df126&amp;source=constructor" width="100%" height="650" frameborder="0"></iframe>
@endsection
