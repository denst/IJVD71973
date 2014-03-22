<div class="page-header">
    <h2>Заявки в клуб: <?php echo isset($page) ? "редактирование" : "добавление"; ?></h2>
</div>
<?php if (count($errors)): ?>
<div id="msgbox" class="box-error">
    <?php foreach ($errors as $error): ?>
    <?php echo is_array($error) ? implode("<br>", $error) : $error; ?><br>
    <?php endforeach; ?>
</div>
<script>
    $(document).ready(function() {
        $("#msgbox").show().delay(5000).fadeOut();
    });
</script>
<?php endif; ?>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'hrusers'))?>
        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend></legend>
                <div class="control-group">
                    <?php echo Form::label('firstname', 'Имя', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('firstname', @$post['firstname'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('lastname', 'Фамилия', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('lastname', @$post['lastname'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('company', 'Компания', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('company', @$post['company'], array('class' => 'span4', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('post', 'Должность', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('post', @$post['post'], array('class' => 'span4', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('email', 'Email', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('email', @$post['email'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('telephone', 'Телефон', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('telephone', @$post['telephone'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <?php echo Form::submit('submit', "Сохранить", array("class" => "btn btn-primary")); ?>
                </div>
            </fieldset>
        </form>
    </div>
</div>