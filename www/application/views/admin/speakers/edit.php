<?php
echo HTML::script('assets/js/bootstrap-typeahead.js');
echo HTML::script('assets/select2/select2.min.js');
echo HTML::style('assets/select2/select2.css');
?>
<div class="page-header">
    <h2>HR Клуб: Спикеры: Редактирование</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'speakers'))?>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            <fieldset>
                <div class="control-group">
                    <?php echo Form::label('title', 'Имя', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('firstname', $post['firstname'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('secondname', 'Фамилия', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('secondname', $post['secondname'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('image', 'Фото', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::file('photo'); ?>
                        <?php if (isset($post['photo']) && $post['photo']) : ?>
                            <div style="margin: 50px 0 10px 0;"><img src="<?php echo URL::base() . 'files/speakers/th_' . $post['photo']; ?>"/></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('position', 'Должность', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('position', $post['position'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('info', 'Информация про спикера', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('info', $post['info'], array('class' => 'span6', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('videos', 'Видео', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('videos', $post['videos'], array('class' => 'span6 videos')); ?>
                    </div>
                </div>
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
  $('.typeahead').typeahead();
  $('.videos').select2({
      multiple: true,
      data: <?php echo $videos_array; ?>
  });
</script>