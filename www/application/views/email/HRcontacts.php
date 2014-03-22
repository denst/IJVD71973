<html>
    <head></head>
    <body>
        <p><?php echo date('d.m.Y H:i:s');?></p>
        <p>Имя: <?php echo htmlspecialchars(@$post['firstname']);?></p>
        <p>Фамилия: <?php echo htmlspecialchars(@$post['lastname']);?></p>
        <p>Компания: <?php echo htmlspecialchars(@$post['company']);?></p>
        <p>Должность: <?php echo htmlspecialchars(@$post['post']);?></p>
        <p>Email: <?php echo htmlspecialchars(@$post['email']);?></p>
        <p>Телефон: <?php echo htmlspecialchars(@$post['telephone']);?></p>
    </body>
</html>
    