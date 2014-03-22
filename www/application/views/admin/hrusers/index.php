<div class="user-header">
    <h2>HR клуб</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'hrusers'))?>
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/hrusers/add"), "Добавить", array("class" => "btn btn-primary")); ?>
            <?php echo HTML::anchor(URL::site("admin/hrusers/exportexcel"), "Экспорт в Excel", array("class" => "btn btn-success")); ?>
            <?php echo HTML::anchor(URL::site("admin/hrusers/exportcsv"), "Экспорт в CSV", array("class" => "btn btn-success")); ?>
            <?php echo HTML::anchor(URL::site("admin/hrusers/exportvcard"), "Экспорт в vCard", array("class" => "btn btn-success")); ?>
			<?php echo HTML::anchor(URL::site("admin/hrusers/exporttoword"), "Бейджи", array("class" => "btn btn-success")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Компания</th>
                <th>Должность</th>
                <th>Email</th>
                <th>Телефон</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($hrusers as $hruser): ?>
            <tr>
                <td><?php echo $hruser->id; ?></td>
                <td><?php echo $hruser->firstname; ?></td>
                <td><?php echo $hruser->lastname; ?></td>
                <td><?php echo $hruser->company; ?></td>
                <td><?php echo $hruser->post; ?></td>
                <td><?php echo $hruser->email; ?></td>
                <td><?php echo $hruser->telephone; ?></td>
               <!-- <td><?php //echo $hruser->last_login ? date('d.m.Y H:i:s', $user->last_login) : "-"; ?></td>-->
                <td>
                    <?php echo HTML::anchor(URL::site("admin/hrusers/edit/{$hruser->id}"), "Редактировать", array("class" => "btn btn-warning")); ?>
                    <?php //if ($hruser->id != $_user->id): ?>
                    <?php echo HTML::anchor(URL::site("admin/hrusers/delete/{$hruser->id}"), "Удалить", array("class" => "btn btn-danger confirmDelete")); ?>
                    <?php //endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>