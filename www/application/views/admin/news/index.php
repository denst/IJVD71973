<div class="page-header">
    <h2>Новости</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/news/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Название</th>
                <th>Дата</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($news as $new): ?>
            <tr>
                <td><?php echo $new->title; ?></td>
                <td><?php echo date('d.m.Y H:i', $new->created); ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/news/edit/{$new->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php echo HTML::anchor(URL::site("admin/news/delete/{$new->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>