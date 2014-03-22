<div class="page-header">
    <h2>Баннеры: <?php echo isset($banner) ? "редактирование" : "добавление"; ?></h2>
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
                    <?php echo Form::label('material', 'Материал', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('material', @$post['material'], array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('description', 'Текст', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea("description", @$post['description'], array('id' => 'description')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('url', 'Ссылка', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('url', @$post['url'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('html_class', 'Класс', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('html_class', @$post['html_class'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('group_id', 'Группа', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::select('group_id', $groups, @$post['group_id']); ?>
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