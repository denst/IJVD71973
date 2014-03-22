<div class="page-header">
    <h2>Группы баннеров: <?php echo isset($group) ? "редактирование" : "добавление"; ?></h2>
</div>
<div class="row">
    <div class="span12">

        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend></legend>
                <div class="control-group">
                    <?php echo Form::label('name', 'Название', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('name', @$post['name'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('group_id', 'Группа', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <div class="checkbox_container">
                            <?php foreach ($pages as $id => $name): ?>
                                <?= Form::checkbox('pages[]', $id, isset($group) && $group->has('pages', $id)) . " {$name}" ?><br/>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('banners_count', 'Количество баннеров на странице', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('banners_count', @$post['banners_count'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <hr>
                <div class="form-actions">
                    <?php echo Form::submit('submit', "Сохранить", array("class" => "btn btn-primary")); ?>
                </div>
            </fieldset>
        </form>

    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#text").cleditor();
  });
</script>