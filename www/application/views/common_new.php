<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo isset($_title) ? $_title . " / " : ""; echo Kohana::$config->load('default.title'); ?></title>
    <meta type="description" value="<?php echo isset($_description) ? $_description : ""; ?>" />
    <meta name="robots" content="index, follow" />
	<!--[if lte IE 6]>
	<meta http-equiv="refresh" content="0; url=http://axes.pro/assets/ieblock/ie6block.html">
	<![endif]-->
    <!-- Stylesheets -->
    <link href="<?php echo URL::base();?>assets/css/reset.css" rel="stylesheet" media="screen" />
    <link href="<?php echo URL::base();?>assets/css/basics.css" rel="stylesheet" media="screen" />
    <link href="<?php echo URL::base();?>assets/css/default.css" rel="stylesheet" media="screen" />
    <link href="<?php echo URL::base();?>assets/css/elements.css" rel="stylesheet" media="screen" />
    <link href="<?php echo URL::base();?>assets/css/skin-<?php echo ! $_page ? 1 : 2 ?>.css" rel="stylesheet" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- Fancy Box style -->
    <link href="<?php echo URL::base();?>assets/css/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" />
    <!-- Royalslider Styles -->
    <link rel="stylesheet" href="<?php echo URL::base();?>assets/css/royalslider.css" />
    <link rel="stylesheet" href="<?php echo URL::base();?>assets/css/royalslider-skins/default/default.css" />
    <link rel="stylesheet" href="<?php echo URL::base();?>assets/css/royalslider-preview.css" />
    <!-- Bugfixes for IE -->
    <!--[if IE]><link href="<?php echo URL::base();?>assets/css/ie.css" rel="stylesheet" type="text/css"><![endif]-->
    <link rel="apple-touch-icon" href="<?php echo URL::base();?>assets/images/iphone_icon.png" />
    <link rel="shortcut icon" href="<?php echo URL::base();?>assets/images/favicon.ico" type="image/x-icon" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="http://feeds.feedburner.com/axespro" />
    <!-- Bugfixes for IE -->
    <!--[if IE]><link href="?php echo URL::base();?>assets/css/ie.css" rel="stylesheet" type="text/css"><![endif]-->
    <!-- jQuery framework -->
    <script src="<?php echo URL::base();?>assets/js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo URL::base();?>assets/js/jquery.easing.1.3.min.js"></script>
    <!-- Royalslider JS -->
    <script src="<?php echo URL::base();?>assets/js/royal-slider-8.1.min.js"></script>
    <!-- FancyBox -->
    <script type="text/javascript" src="<?php echo URL::base();?>assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <!-- Tooltip -->
    <script type="text/javascript" src="<?php echo URL::base();?>assets/js/tooltip.js"></script>
    <!-- Masked Input -->
    <script type="text/javascript" src="<?php echo URL::base();?>assets/js/jquery.maskedinput.min.js"></script>

    <!-- Custom javascript for this template -->
    <script type="text/javascript" src="<?php echo URL::base();?>assets/js/custom.js"></script>
</head>
<body>
<!--noindex-->
<noindex>
<!--LiveInternet counter--><script type="text/javascript">new Image().src = "//counter.yadro.ru/hit?r" + escape(document.referrer) + ((typeof(screen)=="undefined")?"" : ";s"+screen.width+"*"+screen.height+"*" + (screen.colorDepth?screen.colorDepth:screen.pixelDepth)) + ";u"+escape(document.URL) + ";h"+escape(document.title.substring(0,80)) + ";" +Math.random();</script><!--/LiveInternet--></noindex>
<!--/noindex-->
<!-- Топ 42 Меню и Лого -->
<?php ProfilerToolbar::render(true); ?>
<div id="topA">
	<div id="top">
		<div id="logosmall"><a href="<?php echo URL::base();?>"><img src="<?php echo URL::base();?>assets/images/logosmall2.png" alt="AXES Pro"></a></div>
		<div id="nav42">
		<ul>
		            <?php foreach (ORM::factory('page')->where('parent_id', '=', 0)->and_where('menu', '=', 1)->order_by('id')->find_all() as $page): ?>
		                <?php
		                    $class = $_page == $page->url ? "active" : "";
		                    $class .= $page->module == "contacts" ? " ttip" : "";
		                ?>
		                <?php if ($_page || $page->url): ?>
			<li class="<?php echo $class; ?>" <?php if ($page->module == "contacts"):?>original-title="<?php echo $_options['contacts_phone']->value;?>"<?php endif; ?>><a href="<?php echo URL::site($page->url); ?>"><?php echo $page->title;?></a></li>
		                <?php endif; ?>
		            <?php endforeach; ?>
					<li class="ttip" title="English"><a href="http://en.axes.pro" target="_blank"><img src="<?php echo URL::base();?>assets/images/flag/gb.png" /></a></li>
		            <!--<?php if (!Auth::instance()->logged_in() && !$linkedin_logged_in && !$facebook_logged_in): ?>
		            <li class="ttip" title="Вход для пользователей" ><a class="login" href="#"><i class="icon-eye-open"></i></a></li>
		            <?php else: ?>
		                <?php if (Auth::instance()->logged_in()): ?>
		                    <li class="<?php echo $_page == "private" ? "active" : ""; ?>"><a href="<?php echo URL::site("private"); ?>"><i class="icon-user"></i></a></li>
		                    <li class="ttip" original-title="Выход"><a href="<?php echo URL::site('private/logout');?>"><i class="icon-off"></i></a>
		                <?php elseif ($linkedin_logged_in): ?>
		                    <li class="ttip" original-title="Выход (<?php echo $linkedin;?>)"><a href="<?php echo URL::site('oauth/logout');?>"><i class="icon-off"></i></a>
		                <?php else: ?>
		                    <li class="ttip" original-title="Выход (<?php echo $facebook;?>)"><a href="<?php echo URL::site('oauth/logout');?>"><i class="icon-off"></i></a>
		                <?php endif; ?>
		            <?php endif; ?>-->
		</ul>
		</div>

	</div>
</div>
<!-- Конец 42 меню и лого-->
<!-- Начало слайдера -->
<?php if(!$_page) { ?>
<div id="slider-ajax-container">
    <div id="banner-rotator" class="royalSlider default">
        <ul class="royalSlidesContainer">
            <?php echo $_options['index_1']->value; ?>
        </ul>
    </div>
</div>
<?php } ?>
<!-- Конец слайдера -->
<div id="wrapper">

   <!--noindex-->
        <noindex>
        <div id="con-slider">
		<a class="close ttip" href="#" style="float:right;" title="Скрыть панель"><i class="icon-remove"></i></a>
		<div class="clearfix"></div>
            <?php if ($_page != "request"): ?>
            <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_captcha();" >
                <div class="box-error" style="display:none;"></div>
                <?php if ($_page != "career"): ?>
                <fieldset>
                    <p>
                        <input placeholder="Имя" name="con[firstname]" class="required" id="cname" type="text"/>
                        <input placeholder="Фамилия" name="con[lastname]" class="required" id="clastname" type="text"/>
                    </p>
                    <p>
                        <input placeholder="E-mail" name="con[email]" class="required email" id="cemail" type="text"/>
                        <input placeholder="Телефон" name="con[phone]" class="required" id="cphone" type="text"/></p>
                    <p>
                        <input placeholder="Компания" name="con[company]" class="required" id="ccompany" type="text"/>
                        <select name="con[theme]">
                            <option disabled="disabled">Выберите вид заявки</option>
                            <?php foreach (Kohana::$config->load('default.conversion_types') as $key=>$value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select></p>
                    <div class="checkit">
                        <?php $cart = Model_Cart::get_cart_ids(); ?>
                        <h4>Услуги и решения</h4>
                        <?php foreach (Helper_Default::get_by_type(1) as $key => $value): ?>
                            <p><label for="el_<?php echo $key; ?>"><input name="el_<?php echo $key; ?>" id="el_<?php echo $key; ?>" value="1" type="checkbox" <?php echo in_array($key, $cart) ? "checked" : "" ?>><?php echo $value; ?></label></p>
                        <?php endforeach; ?>
						<div class="hr2"></div>
						<?php foreach (Helper_Default::get_by_type(4) as $key => $value): ?>
                            <p><label for="el_<?php echo $key; ?>"><input name="el_<?php echo $key; ?>" id="el_<?php echo $key; ?>" value="1" type="checkbox" <?php echo in_array($key, $cart) ? "checked" : "" ?>><?php echo $value; ?></label></p>
                        <?php endforeach; ?>
                    </div>

                    <div class="checkit2">
                        <h4>Продукты</h4>
                        <?php foreach (Helper_Default::get_by_type(3) as $key => $value): ?>
                            <p><label for="el_<?php echo $key; ?>"><input name="el_<?php echo $key; ?>" id="el_<?php echo $key; ?>" value="1" type="checkbox" <?php echo in_array($key, $cart) ? "checked" : "" ?>><?php echo $value; ?></label></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="checkit">
                        <h4>Модули Lumesse ETWeb</h4>
                        <?php foreach (Helper_Default::get_by_type(2) as $key => $value): ?>
                            <p><label for="el_<?php echo $key; ?>"><input name="el_<?php echo $key; ?>" id="el_<?php echo $key; ?>" value="1" type="checkbox" <?php echo in_array($key, $cart) ? "checked" : "" ?>><?php echo $value; ?></label></p>
                        <?php endforeach; ?>
                    </div>
<div class="clearfix"></div>
                    <textarea cols="30" rows="10" class="required" name="con[comment]" id="ccomment"></textarea>
                </fieldset>
                <!--<div id="recaptcha_widget"></div>-->
                <script type="text/javascript"
                    src="http://www.google.com/recaptcha/api/challenge?k=6Lezsu0SAAAAAM7Elqh4GaBAHCQIA_75T-7c84WB">
                </script>
                <noscript>
                   <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Lezsu0SAAAAAM7Elqh4GaBAHCQIA_75T-7c84WB"
                       height="300" width="500" frameborder="0"></iframe><br>
                   <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                   </textarea>
                   <input type="hidden" name="recaptcha_response_field"
                       value="manual_challenge">
                </noscript>
                <span id="test-span" class="btn btn-primary">Test button</span>
                <button type="submit" class="btn btn-primary">Отправить запрос</button>
                <?php else: ?>
                <fieldset>
                    <p>
                        <input placeholder="Имя" name="res[firstname]" class="required" id="cname" type="text"/>
                        <input placeholder="Фамилия" name="res[lastname]" class="required" id="clastname" type="text"/>
                    </p>
                    <p>
                        <input placeholder="E-mail" name="res[email]" class="required email" id="cemail" type="text"/>
                        <input placeholder="Телефон" name="res[phone]" class="required" id="cphone" type="text"/>
                    </p>
                    <p>
                        <input type="file" name="file" />
                    </p>
                    <div class="clearfix"></div>
                    <textarea cols="30" rows="10" class="required" name="res[comment]" id="ccomment"></textarea>
                </fieldset>
                <button type="submit" class="btn btn-primary">Отправить запрос</button>
                <?php endif; ?>
            </form>
            <?php endif; ?>
		</div>
        </noindex>
		 <!--/noindex-->
        <?php echo isset($content) ? $content : ""; ?>


	<!-- end wrapper / end of document -->
	</div>

<!-- Футер -->
    <div id="footer">
        <?php echo $_options['footer']->value; ?>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter13821520 = new Ya.Metrika({id:13821520, enableAll: true, ut:"noindex", webvisor:true});
        } catch(e) {}
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/13821520?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>

<script type="text/javascript">
    

    function add_to_cart(id) {
        $.post('<?php echo URL::site('ajax/addtocart');?>',
               { id: "" + id + "" },
               function(data) {
                   check_cart();
                   $("#con-message").show().delay(5000).fadeOut();
               }
        );
    }

    function check_cart() {
        $.post('<?php echo URL::site('ajax/getcartcount');?>',
               function(data) {
                   <?php if ($_page != "career"): ?>
                   if (Number(data) > 0) {
                       $("#btn-order").removeClass('btn-success btn-primary');
                       $("#btn-order").addClass("btn-success");

                       $("#btn-order").html('Отправить запросы (' + data + ')');
                       $("#btn-order").attr('original-title' , 'Вы добавили ' + data + ' запрос(ов)');
                   }
                   else {
                       $("#btn-order").removeClass('btn-success btn-primary');
                       $("#btn-order").addClass("btn-primary");
                       $("#btn-order").html('Отправить запрос');
                   }
                   <?php endif; ?>
               }
        );

        $.post('<?php echo URL::site('ajax/getcart');?>',
               function(data) {
                    var data = $.parseJSON(data);
                    for ( key in data ) {
                        if(data.hasOwnProperty(key)){
                            $("#el_" + data[key] + "").attr('checked', true);
                        }
                    }
               }
        );
    }
    
    function check_captcha() {
        $.ajax({
            url: "/ajax/checkcaptcha",
            type: "POST",
            data: ({
                recaptcha_challenge_field: $('#recaptcha_challenge_field').val(),
                recaptcha_response_field: $('#recaptcha_response_field').val()
            }),
            dataType: "json",
            success: function(msg){
                if(msg.result == false){
                   $("#recaptcha_reload").click();
                   $(".box-error").html("Не верный текст капчи");
                   $(".box-error").show().delay(6000).fadeOut();
                   return false;
                }
                else{
                    check_con_form();
                }
            }
         }
      );
      return false;
    }
//    function check_captcha() {
//        $.ajax({
//            url: "/ajax/checkcaptcha",
//            type: "POST",
//            data: ({
//                recaptcha_challenge_field: $('#recaptcha_challenge_field').val(),
//                recaptcha_response_field: $('#recaptcha_response_field').val()
//            }),
//            dataType: "json",
//            success: function(msg){
//                if(msg.result == false){
//                   $("#recaptcha_reload").click();
//                   $(".box-error").html("Не верный текст капчи");
//                   $(".box-error").show().delay(6000).fadeOut();
//                   return false;
//                }
//                else{
//                    check_con_form();
//                }
//            }
//         }
//      );
//    }

    $(document).ready(function() {
        check_cart();
//        $('#con-slider button[type="submit"]').click(function(){
//            $.ajax({
//                url: "/ajax/checkcaptcha",
//                type: "POST",
//                data: ({
//                    recaptcha_challenge_field: $('#recaptcha_challenge_field').val(),
//                    recaptcha_response_field: $('#recaptcha_response_field').val()
//                }),
//                dataType: "json",
//                success: function(msg){
//                    if(msg.result == false){
//                       $("#recaptcha_reload").click();
//                       $(".box-error").html("Не верный текст капчи");
//                       $(".box-error").show().delay(6000).fadeOut();
//                       return false;
//                    }
//                    else{
//                        check_con_form
//                    }
//                }
//             }
//          );
//        });
    });

    $('#newsForm').submit(function() {
      //document.location.href = 'http://google.com/search?q=' + $('#bname').val() + ' site:http://axes.pro';
      window.open('http://google.com/search?q=' + $('#bname').val() + ' site:http://axes.pro');
      return false;
    });

    $("label input:checkbox").click(function(){
        var name = $(this).attr('name');
        if (name.substr(0, 3) == 'el_') {
            var id = name.substr(3);

            if ($(this).attr('checked') != 'checked') {
                $.post('<?php echo URL::site('ajax/deletefromcart');?>',
                   { id: "" + id + "" },
                   function(data) {
                       check_cart();
                   }
                );
            } else {
                $.post('<?php echo URL::site('ajax/addtocart');?>',
                   { id: "" + id + "" },
                   function(data) {
                       check_cart();
                   }
                );
            }
        }
    });

    function check_con_form() {
//        if ($("#cname").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Имя'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#clastname").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Фамилия'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#cemail").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'E-mail'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#cphone").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Телефон'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
        return true;
    }
//    function check_con_form() {
//        if ($("#cname").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Имя'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#clastname").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Фамилия'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#cemail").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'E-mail'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        if ($("#cphone").val() == '') {
//            $(".box-error").html("Вы не заполнили поле 'Телефон'");
//            $(".box-error").show().delay(6000).fadeOut();
//            return false;
//        }
//        return true;
//    }
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30197410-1']);
  _gaq.push(['_setDomainName', 'axes.pro']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</html>

<?php if (isset($last_news)) { ?>
<div style="display:none">
    <div class="sempermachina purple lastNews">
      <h5>Последняя новость</h5>
      <h4><a href="<?= Kohana::$base_url ?><?= $last_news['url']?>"><?= $last_news['title'] ?></a></h4>
                  <em><?= $last_news['annotation'] ?></em>
    </div>
</div>
<?php } ?>

<?php if (isset($banners)) : ?>
<?php foreach ($banners as $banner) : ?>
<div style="display:none">
    <div class="sempermachina purple bannersrotatoritem">
      <h5><?= $banner->name ?></h5>
      <h4><a href="<?= Kohana::$base_url ?><?= $banner->url?>"><?= $banner->material ?></a></h4>
                  <em><?= $banner->description ?></em>
    </div>
</div>
<?php endforeach ?>
<?php endif ?>