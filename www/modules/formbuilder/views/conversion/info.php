<div class="page-header">
    <h2><?php echo $conversion->form_title?></h2>
</div>
<div class="row">
    <div class="span12">
        <table class="table table-bordered">
              <tbody>
                <tr>
                    <td>
                        <small><?php echo $conversion->date?></small>
                        <p class="lead"><?php echo $conversion->company?></p>
                    </td>
                    <td>
                         <h5><?php echo $conversion->fio?></h5>
                         <h5><a href="mailto:e-mail"><?php echo $conversion->email?></a></h5>
                         <h5><?php echo $conversion->phone?></h5>
                    </td>
                </tr>
                
                <?php $fields = json_decode($conversion->fields);
                    foreach ($fields as $field){
                        list($title, $element, $id, $value) = $field;?>
                        
                        <?php if($element == "textarea"):?>
                            <tr>
                              <td colspan="2">
                                <h5><?php echo $title;?></h5>
                                <blockquote>
                                    <small><?php echo $value;?></small>
                                </blockquote>
                              </td>
                            </tr>
                        <?php else:?>
                            <tr>
                                <td><code><?php echo $title;?></code></td>
                                <?php if(is_array($value)):?>
                                    <td>
                                        <?php foreach ($value as $val):?>
                                            <?php echo $val.'<br />';?>
                                        <?php endforeach;?>
                                    </td>
                               <?php else:?>
                                    <td> <?php echo $value;?></td>
                                <?php endif;?>
                            </tr>
                        <?php endif;?>
                <?php }?>
                <?php if(Valid::not_empty($conversion->file_path)):?>
                    <tr>
                        <td><code>file</code></td>
                        <td><a href="<?php echo URL::base('http').$conversion->file_path?>">file</a></td>
                     </tr>    
                <?php endif;?>
              </tbody>
            </table>
			
				
	</div>
	
	<div class="span12 form-actions">
            <?php echo HTML::anchor(URL::site("admin/conversion"), " ← Обратно к списку форм", array("class" => "btn")); ?>
        </div>
</div> 