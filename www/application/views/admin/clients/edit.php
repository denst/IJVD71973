<div class="page-header">
    <h2>Клиент: <?php echo isset($page) ? "редактирование" : "добавление"; ?></h2>
</div>
<div class="row">
    <div class="span12">   

        <form class="form-horizontal" method="POST" enctype="multipart/form-data" >
            <fieldset>
                <legend></legend>
                <div class="control-group">
                    <?php echo Form::label('title', 'Название', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('title', @$post['title'], array('class' => 'span4')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('annotation', 'Аннотация', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea('annotation', @$post['annotation'], array('class' => 'span6', 'rows' => 4)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('text', 'Текст', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea("text", @$post['text'], array('id' => 'text')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo Form::label('image', 'Изображение', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::file('image'); ?>
                        <?php if (isset($post['filename']) && $post['filename']) : ?>
                        <div style="margin: 50px 0 10px 0;"><img src="<?php echo URL::base() . 'files/clients/th_' . $post['filename']; ?>"/></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!--hr>
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
                </div-->
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