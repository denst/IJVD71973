<div class="page-header">
    <h2>Настройки</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Название</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($options as $option): ?>
            <tr>
                <td><?php echo $option->title; ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/options/edit/{$option->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>