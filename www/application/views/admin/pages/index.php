<div class="page-header">
    <h2>Страницы</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/pages/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>URL</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($pages as $page): ?>
            <tr>
                <td><b><?php echo $page->id; ?></b></td>
                <td><?php echo $page->title; ?></td>
                <td><?php echo URL::site() . $page->url; ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/pages/edit/{$page->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php if (! $page->is_protected()): ?>
                    <?php echo HTML::anchor(URL::site("admin/pages/delete/{$page->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>