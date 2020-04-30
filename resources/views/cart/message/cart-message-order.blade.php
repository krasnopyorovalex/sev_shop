Имя: {{ $data['name'] }}
Телефон: {{ $data['phone'] }}
Адрес: {{ $data['address'] }}
Дата доставки: {{ $data['date'] }}
Время доставки: {{ $data['time'] }}
@if($data['comment'])
Комментарий: {{ $data['comment'] }}
@endif
