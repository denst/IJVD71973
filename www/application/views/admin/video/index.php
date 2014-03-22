<div class="page-header">
    <h2>HR Клуб: Видео</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'video'))?>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/video/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Ссылка</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item->title); ?></td>
                <td><?php echo nl2br(htmlspecialchars($item->annotation)); ?></td>
                <td><?php echo $item->link; ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/video/edit/{$item->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php echo HTML::anchor(URL::site("admin/video/delete/{$item->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>