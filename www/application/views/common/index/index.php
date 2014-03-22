<div class="full-width" id="contentWrap">
    <div id="content">

        <div class="hrnoline"></div>
        <div class="intro">
            <?php echo $_options['index_2']->value; ?>
        </div>
        <div class="hrnoline"></div>


        <?php echo $_options['index_5']->value; ?>
        <?php echo $_options['index_4']->value; ?>
          
        <?php foreach (ORM::factory('new')->order_by('created', 'desc')->limit(1)->find_all() as $new): ?>
            <!-- баннер -->
            
                <div class="bannerbox"  id="lastb"  onclick="location.href='<?php echo URL::site("news/{$new->id}"); ?>';">
                   <a href="<?php echo URL::site("news/{$new->id}"); ?>"> <h3><?php echo $new->title; ?></h3></a>
                    <p><a href="<?php echo URL::site("news/{$new->id}"); ?>"><?php echo $new->annotation; ?></a></p>
                </div>
            
            <!-- Конец баннера -->
        <?php endforeach; ?>
        
        <div class="hrnoline"></div>
        <div id="clientsbanner1" class="royalSlider default clearfix">    
        <h5>Наши клиенты</h5>	       
            <ul class="royalSlidesContainer" id="testId">
                <?php echo $_options['index_3']->value; ?>
            </ul>    
        </div> <!-- Banner 1 End -->
    </div> <!-- end content -->

    <div class="clearfix"></div>
</div> <!-- end contentwrap -->
