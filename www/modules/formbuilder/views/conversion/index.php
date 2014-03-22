<link rel="stylesheet" href="/formbuilder/css/custom.css">
<script>
$(document).ready(function(){
    $('.btn-delete').live("click", function(){
        $('input[name="conversion_id"]').val($(this).attr('id'));
    });
});
</script>
<div class="page-header">
    <h2>Конверсия</h2>
</div>
<div class="row">
    <div class="span12">
        <div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="">Форма конверсии</a>                        
                </li>
            </ul>
        </div>
        <div class="btn-toolbar">
                <a href="<?php echo URL::base()?>admin/conversion/exportcsv" class="btn btn-success">Экспорт в CSV</a>        </div>
                <pre><b>Заметка:</b> Обращения сортируются по дате, сверху свежие</pre>
        <table class="table table-striped" id="list">
            <thead>
            <tr>
                <th>Форма</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Компания</th>
                <th>Email</th>
                <th>Дата</th>
                <th style="width: 250px;">Действия</th>
            </tr>
            </thead>
            <tbody>
                <?php $id = 1;?>
                <?php foreach ($conversions as $info):?>
                    <tr>
                        <td><?=$info->form_title?></td>
                        <td><?=$info->fio?></td>
                        <td><?=$info->phone?></td>
                        <td><?=$info->company?></td>
                        <td><?=$info->email?></td>
                        <td><b><?=$info->date?></b></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo URL::base()?>admin/conversion/info/<?php echo $info->id;?>" class="btn btn-info">Посмотреть</a>
                                <button class="btn dropdown-toggle btn-info" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a <a data-toggle="modal" id="<?php echo $info->id?>" class="btn-delete" href="#deleteConversion">Удалить</a></li>
                                </ul>
                                <?php if(Valid::not_empty($info->file_path)):?>
                                    <img class="clip" src="/formbuilder/images/clip.png" alt="clip">
                                <?php endif?>
                            </div>					
                        </td>
                    </tr>
                <?php $id++;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div> 
<div class="modal hide" id="deleteConversion">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">✕</button>
      <h3>Вы уверены, что хотите данные формы конверсии?</h3>
  </div>
  <div class="modal-body" style="text-align:center;">
      <div class="row-fluid">
          <div class="span10 offset1">
              <div id="modalTab">
                  <div class="tab-content">
                      <div class="tab-pane active" id="login">
                          <form method="post" action="<?php echo URL::base()?>admin/conversion/delete" name="completed-form">
                              <p>
                                  <input type="hidden" name="conversion_id" value="">
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