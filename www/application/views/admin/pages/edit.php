<div class="page-header">
    <h2>Страницы: <?php echo isset($page) ? "редактирование" : "добавление"; ?></h2>
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
                    <?php echo Form::label('name', 'Title', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('name', @$post['name'], array('class' => 'span4')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('type', 'Тип', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::select('type', Kohana::$config->load('default.types'), @$post['type'], array("onchange" => "checktype();", 'id' => 'type')); ?>
                    </div>
                </div>

                <div id="product_type" style="display: none;">
                <div class="control-group">
                    <?php echo Form::label('product_type', 'Производитель', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::select('product_type', array("< Выберите производителя >", "Lumesse", "Daxtra Technologies", "Intuition"), @$post['product_type']); ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('product_title', 'Подсказка для продукта', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::input('product_title', @$post['product_title'], array('class' => 'span4')); ?>
                    </div>
                </div>
                </div>

                <div class="control-group">
                    <?php echo Form::label('menu', 'Показывать в меню', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::checkbox('menu', 1, @$post['menu'] ? true : false); ?>
                    </div>
                </div>

                <?php if (@!$post['module']): ?>
                <div class="control-group">
                    <?php echo Form::label('url', 'URL', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <b><?php echo URL::base(); ?></b>&nbsp;<?php echo Form::input('url', @$post['url'], array('class' => 'span2')); ?>
                    </div>
                </div>
                <?php endif; ?>


                <?php if (@!$post['module']): ?>
                <?php
                    $parent = array("< нет >");
                    foreach(ORM::factory('page')->where('parent_id', '=', 0)->find_all() as $parent_page) {
                        $parent[$parent_page->id] = $parent_page->title;
                    }
                ?>
                <div class="control-group">
                    <?php echo Form::label('parent_id', 'Родительская страница', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::select("parent_id", $parent, @$post['parent_id']); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!in_array(@$post['module'], array("index", "news"))): ?>
                <div class="control-group">
                    <?php echo Form::label('text', 'Содержание', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo Form::textarea("text", @$post['text'], array('class' => 'span12', 'style' => 'height:300px;')); ?>
                    </div>
                </div>
                <?php endif; ?>
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

<script>
    function checktype() {
        if ($('#type').val() == 3) {
            $('#product_type').show();
        }
        else {
            $('#product_type').hide();
        }
    }
    $(document).ready(function() {
        checktype();
    });
</script>