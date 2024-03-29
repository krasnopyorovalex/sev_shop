<div class="row">
    <div class="col-12">
        <div class="form-order">
            <div class="title">Оформить заказ</div>
            <form action="{{ route('cart.order') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-name">Ваше имя:</label>
                            <input type="text" id="f-name" name="name" value="{{ old('name') }}" minlength="3" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-phone">Ваше номера телефона:</label>
                            <input type="text" id="f-phone" class="phone_field" value="{{ old('phone') }}" name="phone" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="single__block">
                            <label for="f-address">Адрес доставки(г.Севастополь):</label>
                            <input type="text" id="f-address" placeholder="Доставка только по г.Севастополь" value="{{ old('address') }}" name="address" required autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-date">Дата доставки:</label>
                            <input type="text" id="f-date" class="date" value="{{ old('date') }}" name="date" required autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-time">Время доставки:</label>
                            <select id="f-time" name="time">
                                <option value="с 13:00 до 14:00">с 9:00 до 10:00</option>
                                <option value="с 13:00 до 14:00">с 10:00 до 11:00</option>
                                <option value="с 13:00 до 14:00">с 11:00 до 12:00</option>
                                <option value="с 13:00 до 14:00">с 12:00 до 13:00</option>
                                <option value="с 13:00 до 14:00">с 13:00 до 14:00</option>
                                <option value="с 14:00 до 15:00">с 14:00 до 15:00</option>
                                <option value="с 15:00 до 16:00">с 15:00 до 16:00</option>
                                <option value="с 16:00 до 17:00">с 16:00 до 17:00</option>
                                <option value="с 17:00 до 18:00">с 17:00 до 18:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="single__block">
                            <label for="f-comment">Ваш комментарий:</label>
                            <textarea name="comment" id="f-comment">{{ old('comment') }}</textarea>
                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="btn-submit">
                            <button type="submit" class="btn" {{ (int)$total < 1000 ? 'disabled' : ''}}>
                                Отправить заказ
                                {{ svg('send') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
