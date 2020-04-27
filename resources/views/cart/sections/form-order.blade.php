<div class="row">
    <div class="col-12">
        <div class="form-order">
            <div class="title">Оформить заказ</div>
            <form action="#">
                <div class="row">
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-name">Ваше имя:</label>
                            <input type="text" id="f-name">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-phone">Ваше номера телефона:</label>
                            <input type="text" id="f-phone" class="phone_field" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="single__block">
                            <label for="f-address">Адрес доставки(г.Севастополь):</label>
                            <input type="text" id="f-address" placeholder="Доставка только по г.Севастополь" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-date">Дата доставки:</label>
                            <input type="text" id="f-date" class="date"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="single__block">
                            <label for="f-time">Время доставки:</label>
                            <select name="time" id="f-time">
                                <option value="в течение часа">в течение часа</option>
                                <option value="с 13:00 до 14:00">с 13:00 до 14:00</option>
                                <option value="с 14:00 до 15:00">с 14:00 до 15:00</option>
                                <option value="с 15:00 до 16:00">с 15:00 до 16:00</option>
                                <option value="с 16:00 до 17:00">с 16:00 до 17:00</option>
                                <option value="с 17:00 до 18:00">с 17:00 до 18:00</option>
                                <option value="с 18:00 до 19:00">с 18:00 до 19:00</option>
                                <option value="с 19:00 до 20:00">с 19:00 до 20:00</option>
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
                            <textarea name="comment" id="f-comment"></textarea>
                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="btn-submit">
                            <button type="submit" class="btn" {{ (int)$total < 1000 ? 'disabled' : ''}}>
                                Отправить заказ
                                <svg class="icon">
                                    <use xlink:href="./img/symbols.svg#send"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
