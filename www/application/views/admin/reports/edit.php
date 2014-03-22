<?php echo HTML::script('assets/js/bootstrap-typeahead.js');
echo HTML::script('assets/select2/select2.min.js');
echo HTML::style('assets/select2/select2.css');
$tags = ORM::factory('tags4hrclub')->find_all();
$tags_array='[';
for ($i=0;$i<$tags->count();$i++)
{
    if ($i == $tags->count()-1)
        $tags_array.='"'.$tags[$i]->title.'"';
    else
        $tags_array.='"'.$tags[$i]->title.'",';
}
$tags_array.=']';

$topics = ORM::factory('topic')->find_all();
$topics_array='[';
for ($i=0;$i<$topics->count();$i++)
{
    if ($i == $topics->count()-1)
        $topics_array.='"'.$topics[$i]->title.'"';
    else
        $topics_array.='"'.$topics[$i]->title.'",';
}
$topics_array.=']';
?>
<div class="page-header">
    <h2>HR Клуб: Отчёты: Рредактирование</h2>
</div>
<div class="row">
    <div class="span12">
        <?php echo View::factory('admin/hrclub/menu', array('selected' => 'reports'))?>
        <form class="form-horizontal" method="POST">
            <fieldset>
                <div class="control-group">
                    <?php echo Form::label('title', 'Название', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('title', $post['title'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('annotation', 'Описание', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('annotation', $post['annotation'], array('class' => 'span6', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('content', 'Содержание', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('content', $post['content'], array('class' => 'span6 text', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('materials', 'Материалы', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('materials', $post['materials'], array('class' => 'span6 materials')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('topic', 'Темы', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('topic', $post['topic'], array('class' => 'span6', 'rows' => 4,'data-provide'=>'typeahead','data-source'=>$topics_array)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('tags', 'Теги', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('tags', $post['tags'], array('class' => 'span6', 'rows' => 4,'data-provide'=>'typeahead','data-source'=>$tags_array)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('link_facebook', 'Ссылка на фотографии в Facebook', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('link_facebook', $post['link_facebook'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('link_google', 'Ссылка на фотографии в Google+', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('link_google', $post['link_google'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('speakers', 'Спикеры', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('speakers', $post['speakers'], array('class' => 'span6 speakers')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('videos', 'Видео', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('videos', $post['videos'], array('class' => 'span6 videos')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('visible', 'Показывать', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::checkbox('visible', 1, $post['visible'] ? true : false); ?>
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
    $(".text").cleditor();
  });
  $('.typeahead').typeahead();
  $('.speakers').select2({
      multiple: true,
      data: <?php echo $speakers_array; ?>
  });
  $('.materials').select2({
      multiple: true,
      data: <?php echo $materials_array; ?>
  });
  $('.videos').select2({
      multiple: true,
      data: <?php echo $videos_array; ?>
  });
</script>