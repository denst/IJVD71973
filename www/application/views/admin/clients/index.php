<div class="page-header">
    <h2>Клиенты</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/clients/add"), "Добавить", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Название</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($clients as $client): ?>
            <tr>
                <td><?php echo $client->title; ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/clients/edit/{$client->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php echo HTML::anchor(URL::site("admin/clients/delete/{$client->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>