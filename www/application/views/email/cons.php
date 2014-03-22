<html>
    <head></head>
    <body>
        <p><?php echo date('d.m.Y H:i:s');?></p>
        <p>Имя: <?php echo htmlspecialchars(@$post['firstname']);?></p>
        <p>Фамилия: <?php echo htmlspecialchars(@$post['lastname']);?></p>
        <p>Компания: <?php echo htmlspecialchars(@$post['company']);?></p>
        <p>Email: <?php echo htmlspecialchars(@$post['email']);?></p>
        <p>Телефон: <?php echo htmlspecialchars(@$post['phone']);?></p>
        <p>Тип: <?php echo @$conversion_types[@$post['theme']];?></p>
        <hr>
        <p>
        <ul>
            <?php foreach ($titles as $title): ?>
            <li><?php echo $title;?></li>
            <?php endforeach; ?>
        </ul>
        </p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars(@$post['comment']));?></p>
    </body>
</html>
