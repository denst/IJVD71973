<html>
    <head></head>
    <body>
        <p><?php echo date('d.m.Y H:i:s');?></p>
        <p>ФИО: <?php echo htmlspecialchars(@$post['cname']);?></p>
        <p>Компания: <?php echo htmlspecialchars(@$post['ccompany']);?></p>
        <p>Должность: <?php echo htmlspecialchars(@$post['cposition']);?></p>
        <p>Email: <?php echo htmlspecialchars(@$post['cemail']);?></p>
        <hr>
        <p><a href="<?php echo $link; ?>"><?php echo $name; ?></a></p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars(@$post['ccomment']));?></p>
    </body>
</html>
    