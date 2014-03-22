<?php echo HTML::script('assets/js/bootstrap-typeahead.js');
$tags = ORM::factory('tag')->find_all();
$tags_array='[';
for ($i=0;$i<$tags->count();$i++)
{
    if ($i == $tags->count()-1)
        $tags_array.='"'.$tags[$i]->title.'"';
    else
        $tags_array.='"'.$tags[$i]->title.'",';
}
$tags_array.=']';
?>
<div class="page-header">
    <h2>Новости: <?php echo isset($page) ? "редактирование" : "добавление"; ?></h2>
</div>
<div class="row">
    <div class="span12">   

        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend></legend>
                <div class="control-group">
                    <?php echo Form::label('title', 'Название', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('title', @$post['title'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('category', 'Категория', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::select('category', Kohana::$config->load('default.categories'), @$post['category'], array('class' => 'span6')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('annotation', 'Аннотация', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('annotation', @$post['annotation'], array('class' => 'span6', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('tags', 'Теги', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('tags', @$post['tags'], array('class' => 'span6', 'rows' => 4,'data-provide'=>'typeahead','data-source'=>$tags_array)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('text', 'Содержание', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea("text", @$post['text'], array('id' => 'text')); ?>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="control-group">
                        <div class="controls">
                            <a href="javascript:void(0)" onclick="$('#seo').show();">Поисковая оптимизация</a>
                        </div>
                    </div>
                    <div id="seo" style="display: none;">
                        <div class="control-group">
                            <?php echo Form::label('keywords', 'Ключевые слова', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo Form::textarea('keywords', @$post['keywords'], array('class' => 'span6', 'rows' => 3)); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php echo Form::label('description', 'Описание', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo Form::textarea('description', @$post['description'], array('class' => 'span6', 'rows' => 3)); ?>
                            </div>
                        </div>
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
</script>