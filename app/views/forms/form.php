<form action="<?=$action?>" method="post">
    <div class="form-group">
        <label for="album_name">Название альбома</label>
        <input type="text" class="form-control" id="album_name" name="album_name" placeholder="Название альбома" value="<?=$item['album_name'] ?? ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="artist_name">Название артиста</label>
        <input type="text" class="form-control" id="artist_name" name="artist_name" placeholder="Название артиста" value="<?=$item['name'] ?? ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="year_of_issue">Год выпуска</label>
        <input type="text" class="form-control" id="year_of_issue" name="year_of_issue" placeholder="Год выпуска" value="<?=$item['year_of_issue'] ?? ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="durations">Длительность альбома</label>
        <input type="text" class="form-control" id="durations" name="durations" placeholder="Длительность альбома (минут)" value="<?=$item['durations'] ?? ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="buy_date">Дата покупки</label>
        <input type="text" class="form-control" id="buy_date" name="buy_date" placeholder="Дата покупки" value="<?=isset($item['buy_date']) ? (date("d.m.Y", strtotime($item['buy_date'] ?? ''))) : ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="price">Стоимость покупки</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Стоимость покупки" value="<?=isset($item['price']) ? $item['price'] / 100 : ''?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="position">Код хранилища</label>
        <input type="text" class="form-control" id="position" name="position" placeholder="Код хранилища (номер комнаты : номер стойки : номер полки)" value="<?=isset($item['position_room']) ? $item['position_room'] . ":" : '' ?><?=isset($item['position_rack']) ? $item['position_rack'] . ":": ''?><?=$item['position_shelf'] ?? ''?>">
        <span class="help-block"></span>
    </div>
</form>
