<div class="user-header">
    <h2>Баннеры</h2>
</div>
<div class="row">
    <div class="span12">
        <div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?= URL::site("admin/bannersrotator") ?>">Баннеры</a>
                </li>
                <li>
                    <a href="<?= URL::site("admin/bannersrotator/groups") ?>">Группы</a>
                </li>
            </ul>
        </div>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/bannersrotator/add"), "Добавить баннер", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Название материала</th>
                    <th>Описание</th>
                    <th>Ссылка</th>
                    <th style="width: 250px;">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($banners as $banner) : ?>
                <tr>
                    <td><?= $banner->id ?></td>
                    <td><?= $banner->name ?></td>
                    <td><?= $banner->material ?></td>
                    <td width='30%'><?= $banner->description ?></td>
                    <td><?= $banner->url ?></td>
                    <td>
                        <a href="<?= URL::site('admin/bannersrotator/edit/' . $banner->id) ?>" class="btn btn-warning">Редактировать</a>
                        <a href="<?= URL::site('admin/bannersrotator/delete/' . $banner->id) ?>" class="btn btn-danger confirmDelete">Удалить</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>