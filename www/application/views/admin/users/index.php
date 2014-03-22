<div class="user-header">
    <h2>Страницы</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/users/add"), "Добавить", array("class" => "btn btn-primary")); ?>
            <?php echo HTML::anchor(URL::site("admin/users/exportcsv"), "Экспорт в CSV", array("class" => "btn btn-success")); ?>
            <?php echo HTML::anchor(URL::site("admin/users/exportvcard"), "Экспорт в vCard", array("class" => "btn btn-success")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Логин</th>
                <th>Email</th>
                <th>Компания</th>
                <th>Активность</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->company; ?></td>
                <td><?php echo $user->last_login ? date('d.m.Y H:i:s', $user->last_login) : "-"; ?></td>
                <td>
                    <?php echo HTML::anchor(URL::site("admin/users/edit/{$user->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php if ($user->id != $_user->id): ?>
                    <?php HTML::anchor(URL::site("admin/users/delete/{$user->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>