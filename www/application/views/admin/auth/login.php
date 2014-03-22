<?php ProfilerToolbar::render(true); ?>
<div class="row" style="padding-top: 50px;">
    <div class="span5 offset3">
        <?php echo Message::render(); ?>
        <?php echo Form::open("", array("class" => "form-horizontal")); ?>
        <fieldset>
            <legend style="margin-bottom: 0px;">Вход в систему</legend>
            <div class="control-group">
                <?php echo Form::label("username", "Логин", array("class" => "control-label")); ?>
                <div class="controls">
                    <?php echo Form::input('username', @$post['username']); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo Form::label("password", "Пароль", array("class" => "control-label")); ?>
                <div class="controls">
                    <?php echo Form::password('password'); ?>
                </div>
            </div>
            <div class="form-actions">
                <?php echo Form::submit('submit', "Войти", array("class" => "btn btn-primary")); ?>
            </div>
        </fieldset>
        <?php echo Form::close(); ?>
    </div>
</div>