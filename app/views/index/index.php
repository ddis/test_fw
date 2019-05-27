<?php
$this->title = 'CD list';
?>
<div class="row">
    <div class="col-2">
        <button class="btn btn-success add-new">Add New</button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th scope="col"><a href="/?sort=album_name&order=asc"> Название альбома <span class="glyphicon glyphicon-sort"></span> </a></th>
                <th scope="col">Название артиста <span class="glyphicon glyphicon-sort"></span></th>
                <th scope="col">Год выпуска <span class="glyphicon glyphicon-sort"></span></th>
                <th scope="col">Длительность <span class="glyphicon glyphicon-sort"></span></th>
                <th scope="col">Дата покупки <span class="glyphicon glyphicon-sort"></span></th>
                <th scope="col">Стоимость покупки <span class="glyphicon glyphicon-sort"></span></th>
                <th scope="col">Код хранилища</th>
                <th scope="col" width="250px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item):?>
                <tr data-id="<?=$item['id']?>">
                    <th><?=$item['id']?></th>
                    <td><?=$item['album_name']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['year_of_issue']?></td>
                    <td><?=$item['durations']?></td>
                    <td><?=date("d.m.Y", strtotime($item['buy_date']))?></td>
                    <td><?=($item['price'] / 100)?></td>
                    <td><?=$item['position_room']?>:<?=$item['position_rack']?>:<?=$item['position_shelf']?></td>
                    <td>
                        <button type="button" class="btn btn-warning update">Edit</button>
                        <button type="button" class="btn btn-danger delete">Remove</button>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save">Save changes</button>
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
