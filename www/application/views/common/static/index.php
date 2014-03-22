<!-- Навигация второго уровня-->
<?php if ($_SERVER['REQUEST_URI']!="/superhr"){?>
<div id="navsec">
    <?php $subpage = ORM::factory('page')->where('id', '=', $page->parent_id ? $page->parent_id : $page->id)->find(); ?>
    <?php if ($_page != "career"): ?>
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>
    <?php else: ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить резюме</a>
    <?php endif; ?>
    
    <h1><?php echo $page->title; ?></h1>
    
    <?php $subpages = ORM::factory('page')->where('parent_id', '=', $page->parent_id ? $page->parent_id : $page->id)->and_where('menu', '=', 1)->order_by('id')->find_all(); ?>
    <?php if (count($subpages) && !in_array($subpage->module, array("solutions", "services", "products"))): ?>
    <ul>
        <?php foreach ($subpages as $subpage): ?>
        <li <?php echo $_page == $subpage->url ? 'class="active"' : ''; ?>><?php echo HTML::anchor(URL::site($subpage->url), $subpage->title); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    
    <?php if ($page->product_type): ?>
    <ul>
        <?php foreach (ORM::factory('page')->where('product_type', '=', $page->product_type)->and_where('menu', '=', 1)->order_by('id', 'asc')->find_all() as $subpage): ?>
        <li class="ttip <?php echo $_page == $subpage->url ? 'active' : ''; ?>" original-title="<?php echo $subpage->product_title;?>">
            <?php echo HTML::anchor(URL::site($subpage->url), $subpage->title); ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

</div><!-- Конец второй навигации -->
<?php } if (isset($_message)): ?>
    <div id="msgbox" class="box-information"><?php echo $_message; ?></div>
    <script>
        $(document).ready(function() {
            $("#msgbox").show().delay(5000).fadeOut();
        });
    </script>
<?php endif; ?>

<?php echo Formbuilder::message_render();?>

<div id="con-message" class="box-download" style="display: none;">Ваш запрос добавлен.<br>Вы можете продолжить работу c сайтом или заполнить форму нажав на зеленую кнопку «Отправить запрос»</div>

<div id="contentWrap" class="full-width">
    <!-- Навигация Контент-->
    <div id="content">
        <?php echo isset($content) ? $content : ""; ?>
    </div> <!-- конец контента -->

    <div class="clearfix"></div>
</div> <!-- end contentwrap -->