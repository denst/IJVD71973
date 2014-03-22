<html>
    <head></head>
    <body>
        <p><?php echo date('d.m.Y H:i:s');?></p>
        <p>ФИО: <?php echo htmlspecialchars(@$post['cname']);?></p>
        <p>Компания: <?php echo htmlspecialchars(@$post['ccompany']);?></p>
        <p>Email: <?php echo htmlspecialchars(@$post['cemail']);?></p>
        <p>Телефон: <?php echo htmlspecialchars(@$post['cphone']);?></p>
        <p>Численность: <?php echo htmlspecialchars(@$post['count']);?></p>
        <p>Тип: <?php echo htmlspecialchars(@$post['type']);?></p>
        <hr>
        <p>Модули:</p>
        <p>
        <ul>
            <?php foreach ($titles as $title): ?>
            <li><?php echo $title;?></li>
            <?php endforeach; ?>
        </ul>
        </p>
    </body>
</html>
    