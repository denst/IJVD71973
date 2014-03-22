<div id="page-nav">
    <ul>
        <?php if ($previous_page !== FALSE): ?>
            <li><a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('&lt') ?></a></li>
        <?php endif ?>
        
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>

            <?php if ($i == $current_page): ?>
                <li class="current"><a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
            <?php endif ?>

        <?php endfor ?>
        
        <?php if ($next_page !== FALSE): ?>
            <a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('&gt;') ?></a>
        <?php endif ?>
    </ul>
    <div class="pages">Страница <?php echo $current_page;?> из <?php echo $total_pages; ?></div>
</div>