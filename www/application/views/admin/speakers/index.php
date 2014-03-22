<div class="page-header">
    <h2>HR Клуб: Видео</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'speakers'))?>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/speakers/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Информация</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item->firstname)?></td>
                <td><?php echo htmlspecialchars($item->secondname)?></td>
                <td><?php echo nl2br(htmlspecialchars($item->info))?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/speakers/edit/{$item->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php echo HTML::anchor(URL::site("admin/speakers/delete/{$item->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>