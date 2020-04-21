@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.catalogs.index') }}">Категории каталога</a></li>
    <li><a href="{{ route('admin.catalog_products.index', $catalog) }}">Список товаров</a></li>
    <li class="active">Форма добавления товара</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления товара</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.catalog_products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="catalog_id" value="{{ $catalog }}">

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-9">
                                    @input(['name' => 'name', 'label' => 'Название'])
                                    <div class="row">
                                        <div class="col-md-4">
                                            @input(['name' => 'price', 'label' => 'Цена'])
                                        </div>
                                        <div class="col-md-4">
                                            @input(['name' => 'alias', 'label' => 'Alias'])
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="label">Метка:</label>
                                                <select class="form-control border-blue border-xs select-search" id="slider_id" name="label" data-width="100%">
                                                    @foreach ($labels as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @textarea(['name' => 'text', 'label' => 'Текст'])
                                </div>
                                <div class="col-md-3">
                                    @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @submit_btn()
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
