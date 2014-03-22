<html>
    <head></head>
    <body>
        <p><?php echo date('d.m.Y H:i:s');?></p>
        <p>Имя: <?php echo htmlspecialchars(@$post['firstname']);?></p>
        <p>Фамилия: <?php echo htmlspecialchars(@$post['lastname']);?></p>
        <p>Email: <?php echo htmlspecialchars(@$post['email']);?></p>
        <p>Телефон: <?php echo htmlspecialchars(@$post['phone']);?></p>
        <p><a href="<?php echo $link; ?>"><?php echo $name; ?></a></p>
        <hr>
        <hr>
        <p><?php echo nl2br(htmlspecialchars(@$post['comment']));?></p>
    </body>
</html>
