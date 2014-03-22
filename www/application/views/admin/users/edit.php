<div class="page-header">
    <h2>Пользователь: <?php echo isset($user) ? "редактирование" : "добавление"; ?></h2>
</div>
<div class="row">
    <div class="span12">

        <form  id="create-user-form" class="form-horizontal" method="POST">
            <fieldset>
                <legend></legend>
                <div class="control-group">
                    <?php echo Form::label('email', 'Email', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('email', @$post['email'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('username', 'Логин', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('username', @$post['username'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('password', 'Пароль', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::password('password', "", array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('lastname', 'Фамилия', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('lastname', @$post['lastname'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('firstname', 'Имя', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('firstname', @$post['firstname'], array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('admin', 'Является администратором', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::checkbox('admin', 1, @$post['admin'] ? true : false); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('client', 'Является клиентом', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::checkbox('client', 1, @$post['client'] ? true : false); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('company', 'Организация', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('company', @$post['company'], array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('consultant', 'Консультант', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('consultant', @$post['consultant'], array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('text', 'Текст', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea("text", @$post['text'], array('id' => 'text')); ?>
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