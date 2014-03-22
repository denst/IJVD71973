<html>
    <head></head>
    <body>
        <p><?php echo htmlspecialchars(@$referrer);?></p>
        <hr>
        <p><?php echo $conversion->date;?></p>
        <p>Имя: <?php echo htmlspecialchars(@$conversion->fio);?></p>
        <p>Телефон: <?php echo htmlspecialchars(@$conversion->phone);?></p>
        <p>Компания: <?php echo htmlspecialchars(@$conversion->company);?></p>
        <p>Email: <?php echo htmlspecialchars(@$conversion->email);?></p>
        <hr>
        <?php $fields = json_decode($conversion->fields);
            foreach ($fields as $field){
                list($title, $element, $id, $value) = $field;?>
                <?php if($element == "textarea"):?>
                    <hr>
                    <p><?php echo htmlspecialchars(@$title);?>: <?php echo nl2br(htmlspecialchars(@$value));?></p>
                <?php else:?>
                        <p><?php echo $title;?>: 
                        <?php if(is_array($value)):?>
                                <?php foreach ($value as $val):?>
                                    <?php echo htmlspecialchars(@$val).', ';?>
                                <?php endforeach;?>
                       <?php else:?>
                            <?php echo htmlspecialchars(@$value);?>
                        <?php endif;?></p>
                <?php endif;?>
        <?php }?>
        <?php if(Valid::not_empty($conversion->file_path)):?>
            <p><a href="<?php echo URL::base('http').$conversion->file_path?>">file</a></p>
        <?php endif?>
    </body>
</html>
    