<!-- Навигация второго уровня-->
<div id="navsec">
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>
    
    <h2><?php echo $client->title; ?></h2>
</div><!-- Конец второй навигации -->

<div id="contentWrap" class="full-width">
    <!-- Навигация Контент-->
    <div id="content">
        <?php echo isset($client->text) ? $client->text : ""; ?>
    </div> <!-- конец контента -->
    <div class="clearfix"></div>
</div> <!-- end contentwrap -->