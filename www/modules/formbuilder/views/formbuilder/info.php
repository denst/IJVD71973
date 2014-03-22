<div class="page-header">
    <h2>Форма «<?php echo $form->title;?>» <small><?php echo $form->description;?></small></h2>
</div>
<div class="row">
    <div class="span12">
	<h3>Коды для вставки</h3>
        <div class="form-horizontal">
            <form action="<?php echo URL::base();?>admin/formbuilder/save" method="post">
                <input type="hidden" name="form_id" value="<?php echo $form->id;?>">
                <div class="control-group">
                    <label class="control-label" for="description">Код для вставки в тело страницы</label>
                    <div class="controls">
                        <?php $body = $form->body;
                              $body = str_replace('##form_id', $form->id, $body)?>
                        <textarea name="body" onclick="this.select();" name="description" cols="50" rows="3" class="span8" style="height: 350px;"><?php echo $body;?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
            <hr>
        </div>
    </div>
    
    <div class="span6">
        <h4>Список используемых элементов и их ID</h4>
        <ul>
            <?php $form_info = json_decode($form->info);
                foreach ($form_info as $info):?>
            <li><?php echo $info[0];?> <?php echo htmlspecialchars('<'.strtolower($info[1]).'>');?> <code><?php echo $info[2];?></code></li>
            <?php endforeach;?>
        </ul>
    </div>
    
    <div class="span5">
            <h4>Пример использования ID элементов формы:</h4>
            <p>Данный пример показывает как при помощи кнопки-ссылки можно активировать чекбокс в сгенерированной форме из любого места страницы<p>
            <pre>&lt;a href="javascript:void(0)" onclick="selectInFormConversion(38);"&gt;Добавить в запрос Checkbox1&lt;/a&gt;<hr> Где 38 это ID элемента формы</pre>
    </div>
    <div class="span12 form-actions">
        <?php echo HTML::anchor(URL::site("admin/formbuilder"), " ← Обратно к списку форм", array("class" => "btn")); ?>
    </div>
</div>   