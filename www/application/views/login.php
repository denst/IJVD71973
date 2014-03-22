<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="<?php echo URL::site('favicon.ico');?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo URL::site('favicon.ico');?>" type="image/x-icon" />
    <?php echo HTML::style('media/css/bootstrap.css'); ?>
    <?php echo HTML::style('media/css/bootstrap-responsive.css'); ?>
    <?php echo HTML::script('media/js/jquery-1.7.1.min.js'); ?>
    <title><?php echo isset($_title) ? $_title : ""; ?></title>
</head>
<body>
    <div class="container">
        <?php echo isset($content) ? $content : ""; ?>
    </div>
</body>
</html>