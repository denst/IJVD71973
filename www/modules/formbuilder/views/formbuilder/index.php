<script>
$(document).ready(function(){
    $('.btn-delete').live("click", function(){
        $('input[name="form_id"]').val($(this).attr('id'));
    });
});
</script>
<div class="page-header">
    <h2>Генератор форм конверсии</h2>
</div>
<div class="row">
    <div class="span12">   
        <div class="btn-toolbar">
            <?php echo HTML::anchor(URL::site("admin/formbuilder/create"), "Создать форму", array("class" => "btn btn-primary")); ?>
        </div>
        <table class="table table-striped" id="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th style="width: 250px;">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1;?>
                <?php foreach ($forms as $form):?>
                    <tr>
                        <td><b><?php echo $id;?></b></td>
                        <td><?php echo $form->title?></td>
                        <td><?php echo $form->description?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo URL::base();?>admin/formbuilder/view/<?php echo $form->id;?>" class="btn btn-info">Посмотреть</a>
                                <button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo URL::base();?>admin/formbuilder/info/<?php echo $form->id;?>">Редактировать</a></li>
                                    <li class="divider"></li>
                                    <li><a data-toggle="modal" id="<?php echo $form->id?>" class="btn-delete" href="#deleteForm" >Удалить</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php $id++;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal hide" id="deleteForm">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">✕</button>
      <h3>Вы уверены, что хотите удалить форму?</h3>
  </div>
  <div class="modal-body" style="text-align:center;">
      <div class="row-fluid">
          <div class="span10 offset1">
              <div id="modalTab">
                  <div class="tab-content">
                      <div class="tab-pane active" id="login">
                          <form method="post" action="<?php echo URL::base()?>admin/formbuilder/delete" name="completed-form">
                              <p>
                                  <input type="hidden" name="form_id" value="">
                                  <button type="submit" class="btn btn-primary">Да</button>
                                  <button class="btn btn-primaryclose" data-dismiss="modal">Нет</button>
                              </p>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>