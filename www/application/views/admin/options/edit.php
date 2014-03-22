<div class="page-header">
    <h2>Настройки: <?php echo isset($option) ? $option->title : ""; ?></h2>
</div>
<div class="row">
    <div class="span12">   

        <form class="form-horizontal" method="POST">
            <fieldset>
                <legend></legend>
                
                <div class="control-group">
                    <?php echo Form::label('value', 'Значение', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php 
                            switch($post['type']) {
                                case "editor":
                                    echo Helper_Editor::get("value", @$post['value']);
                                    break;
                                case "textarea":
                                    echo Form::textarea("value", @$post['value'], array('class' => 'span6'));
                                    break;
                                case "text":
                                    echo Form::input("value", @$post['value'], array('class' => 'span6'));
                                    break;                                    
                            }
                        ?>
                    </div>
                </div>

                <div class="form-actions">
                    <?php echo Form::submit('submit', "Сохранить", array("class" => "btn btn-primary")); ?>
                </div>
            </fieldset>
        </form>

    </div>
</div>