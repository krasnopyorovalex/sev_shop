<div class="search-form">
    <form action="{{ route('search') }}" method="get">
        <div class="group">
            <input type="text" placeholder="Поиск" name="keyword" value="{{ request('keyword') }}">
            <button class="submit" type="submit" title="Начать поиск">
                {{ svg('search') }}
                Найти
            </button>
        </div>
    </form>
</div>
