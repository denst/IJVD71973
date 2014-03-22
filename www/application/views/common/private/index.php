<div id="navsec">

    
    <h2>Личный кабинет <?php if ($client):?>(<?php echo $user->company; ?>)<?php endif; ?></h2>
    
    <?php if ($client):?>
    <ul>
    <li>
    Ваш консультант,
    <a href=""><?php echo $user->consultant; ?></a>
    </li>
    </ul>
    <?php endif; ?>
</div>

<div id="contentWrap">
    <div id="content">
        <div class="full-page">
            <?php if ($client):?>
            <?php echo $user->text; ?>
            <?php else: ?>
            Добро пожаловать на сайт!
            <?php endif; ?>
        </div>
        <div class="hr noline"></div>
    </div> <!-- end content -->
    <div class="clearfix"></div>
</div>
