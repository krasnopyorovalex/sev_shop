<body>
    <p>Имя: {{ $data['name'] }}</p>
    <p>Телефон: {{ $data['phone'] }}</p>
    <p>Адрес: {{ $data['address'] }}</p>
    <p>Дата доставки: {{ $data['date'] }}</p>
    <p>Время доставки: {{ $data['time'] }}</p>
    @if($data['comment'])
    <p>Комментарий: {{ $data['comment'] }}</p>
    @endif

    <p>---------------------------------</p>
    <p><b>Описание заказа:</b></p>
    <table style="width: 100%" cellpadding="7" border="1">
        <thead>
        <tr>
            <th>Наименование товара</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        @foreach(app('cart')->getContent() as $item)
            <tr>
                <td>
                    @if($item->attributes->image)
                        <img style="display: inline-block; vertical-align: middle;" src="{{ asset("storage/1c_catalog/{$item->attributes->image}") }}" alt="" width="146" height="132"/>
                    @endif
                    <a style="display: inline-block; vertical-align: middle;" href="{{ $item->attributes->url }}">{{ $item->name }}</a>
                </td>
                <td>{{ number_format($item->price, 0, '.', ' ') }} &#8381;</td>
                <td>
                    {{ $item->quantity }}
                </td>
                <td>{{ number_format($item->quantity * $item->price, 0, '.', ' ') }} &#8381;</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                Общая цена: <b>{{ app('cart')->getTotal() }}</b> &#8381;
            </td>
        </tr>
        </tbody>
    </table>
</body>
