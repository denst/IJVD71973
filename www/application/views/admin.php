<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="<?php echo URL::site('favicon.ico');?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo URL::site('favicon.ico');?>" type="image/x-icon" />
    <?php echo HTML::style('media/css/admin.css'); ?>
    <?php echo HTML::style('media/css/bootstrap.css'); ?>
    <?php echo HTML::style('media/css/bootstrap-responsive.css'); ?>
    <?php echo HTML::script('media/js/jquery-1.7.1.min.js'); ?>
    <?php echo HTML::script('media/js/jquery.dataTables.min.js'); ?>
    <?php echo HTML::script('media/js/bootstrap.js'); ?>
    <?php echo HTML::script('media/js/DT_bootstrap.js'); ?>
    <?php echo HTML::style('media/css/DT_bootstrap.css'); ?>
    <?php echo HTML::script(URL::site('media/js/cleditor/jquery.cleditor.js'));?>
    <?php echo HTML::style(URL::site('media/css/cleditor/jquery.cleditor.css')); ?>
    <title><?php echo isset($_title) ? $_title : ""; ?></title>
</head>
<body data-target=".bs-docs-sidebar" data-spy="scroll" data-twttr-rendered="true">
    <?php // ProfilerToolbar::render(true); ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
<?php echo HTML::anchor(URL::site('admin'), "AXES PRO", array("class" => "brand")); ?>
                <div class="nav-collapse">
                    <ul class="nav">
                        <?php foreach ($_controllers as $title => $url): ?>
                            <?php if (is_array($url)): // submenu ?>
                            <li class="dropdown<?php if (in_array($_controller, $url)): ?> sub-active<?php endif; ?>">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $title ?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($url as $subTitle => $subUrl): ?>
                                        <li<?php if ($subUrl == $_controller): ?> class="active"<?php endif; ?>>
                                            <?php echo HTML::anchor(URL::site('admin/' . $subUrl), $subTitle); ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <?php else: ?>
                            <?php if ($url != "index"): ?>
                            <li <?php if ($url == $_controller): ?>class="active"<?php endif; ?>>
                                <?php echo HTML::anchor(URL::site('admin/' . $url), $title); ?>
                            </li>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li><?php echo HTML::anchor(URL::base(), 'Открыть сайт', array('target' => '_blank')); ?></li>
                        <li><?php echo HTML::anchor(URL::site('admin/logout'), 'Выход'); ?></li>
                        <li class="divider-vertical"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php echo isset($content) ? $content : ""; ?>
    </div>
</body>
<script>
    $(".confirmDelete").click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");

        if (confirm('Вы уверены, что хотите удалить?')) {
            window.location.href = targetUrl;
        }
        else {
            return false;
        }
    });
</script>
</html>