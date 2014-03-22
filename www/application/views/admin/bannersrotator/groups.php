<div class="user-header">
    <h2>Группы баннеров</h2>
</div>
<div class="row">
    <div class="span12">
        <div>
            <ul class="nav nav-tabs">
                <li>
                    <a href="<?= URL::site("admin/bannersrotator") ?>">Баннеры</a>
                </li>
                <li class="active">
                    <a href="<?= URL::site("admin/bannersrotator/groups") ?>">Группы</a>
                </li>
            </ul>
        </div>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/bannersrotator/addgroup"), "Добавить группу", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Количество баннеров</th>
                    <th style="width: 250px;">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $group) : ?>
                <tr>
                    <td><?= $group->id ?></td>
                    <td><?= $group->name ?></td>
                    <td><?= $group->banners_count ?></td>
                    <td>
                        <a href="<?= URL::site('admin/bannersrotator/editgroup/' . $group->id) ?>" class="btn btn-warning">Редактировать</a>
                        <a href="<?= URL::site('admin/bannersrotator/deletegroup/' . $group->id) ?>" class="btn btn-danger confirmDelete">Удалить</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>