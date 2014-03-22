<div id="navsec">
    <?php $subpage = ORM::factory('page')->where('id', '=', $page->parent_id ? $page->parent_id : $page->id)->find(); ?>
    
    <!--a href="#" class="rss"></a-->
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>
    
    <h2>Наши клиенты</h2>
    
    <?php $subpages = ORM::factory('page')->where('parent_id', '=', $page->parent_id ? $page->parent_id : $page->id)->and_where('menu', '=', 1)->order_by('id')->find_all(); ?>
    <?php if (count($subpages) && !in_array($subpage->module, array("solutions", "services", "products"))): ?>
    <ul>
        <?php foreach ($subpages as $subpage): ?>
        <li <?php echo $_page == $subpage->url ? 'class="active"' : ''; ?>><?php echo HTML::anchor(URL::site($subpage->url), $subpage->title); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>

<div id="contentWrap">
    <div class="clients grid">
        <ul>
         <?php $count = 1; foreach($clients as $client): ?>   
         <li <?php echo $count % 3 == 0 ? 'id="lastb"' : ''; ?>>
            <?php if (isset($client->filename) && $client->filename) : ?>
            <center><img alt="<?php echo $client->title; ?>" src="<?php echo URL::base() . 'files/clients/th_' . $client->filename; ?>" class="grid-img"></center>
            <?php endif; ?> 
            <p><?php echo $client->annotation; ?></p>	
            <!-- <?php echo URL::site('clients/' . $client->id); ?> -->
         </li>
         <?php $count++; endforeach; ?>
        </ul>
    </div>
    <div class="hrnoline"></div>
    <div class="hrnoline"></div>
    <?php echo isset($content) ? $content : ""; ?>
    <div class="clearfix"></div>
</div>
