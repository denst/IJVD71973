<div class="page-header">
    <h2>HR Клуб: Отчёты</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'reports'))?>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/reports/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Название</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item->title); ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/reports/edit/{$item->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php echo HTML::anchor(URL::site("admin/reports/delete/{$item->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>