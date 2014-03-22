<?php
$menu = array(
    'speakers' => 'Спикеры',
    'video' => 'Видео',
    'reports' => 'Отчеты',
    'materials' => 'Материалы',
    'hrusers' => 'Заявки на участие <sup>' . $_hrusers_count .'</sup>',
);
?>
<ul class="nav nav-tabs">
    <?php foreach ($menu as $k => $v) { ?>
        <li <?php if ($selected == $k) {
            echo 'class="active"';
        } ?>>
            <?php echo HTML::anchor(URL::site('admin/' . $k), $v) ?>
        </li>
    <?php } ?>
</ul>