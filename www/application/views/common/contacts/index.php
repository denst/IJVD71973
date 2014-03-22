<!-- Навигация второго уровня-->
<div id="navsec">
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>

    <!--a class="con" href="#">Связаться</a-->
    <h2><?php echo $page->title; ?></h2>
    <ul>
  <li><a href="<?= Kohana::$base_url; ?>press">Информация для прессы</a></li>
    </ul>

</div><!-- Конец второй навигации -->

<?php if (isset($_message)): ?>
    <div id="msgbox" class="box-information"><?php echo $_message; ?></div>
    <script>
        $(document).ready(function() {
            $("#msgbox").show().delay(6000).fadeOut();
        });
    </script>
<?php endif; ?>
<?php if(isset($captcha_error_contact)):?>
    <div id="box-error_contact"><?php echo $captcha_error_contact; ?></div>
    <script>
        $(document).ready(function() {
            $("#box-error_contact").show().delay(6000).fadeOut();
        });
    </script>
<?php endif?>

<div id="contentWrap" class="full-width">
    <!-- Навигация Контент-->
    <div id="content">
        <?php echo isset($content) ? $content : ""; ?>
    </div> <!-- конец контента -->
    <div class="clearfix"></div>
	<div class="half-page">
	<h3>Вы всегда можете связаться с нами по следующим контактам:</h3>
	<h5>Тел.: +7 (495) 287-76-14</h5>
	<h5>Факс: +7 (495) 287-66-00</h5>
<p>Мы находимся по адресу: 107078, Москва, Ул. Новорязанская, д.18, стр.21, 5 подъезд, Бизнес Центр «Стендаль». </p>
<p>Всегда рады видеть вас у нас в офисе, мы с радостью угостим вас вкусным чаем или кофе.</p>
<p>Так же вы сможете следить за нашими обновлениями на социальных сетях</p>
<p>
<a href="http://twitter.com/axes_pro" target="_blank"><img src="<?= Kohana::$base_url; ?>assets/images/icons/social/twitter.png"></a>
<a href="http://www.facebook.com/axespro" target="_blank"><img src="<?= Kohana::$base_url; ?>assets/images/icons/social/facebook.png"></a>
<a href="http://www.youtube.com/user/axesprodigital" target="_blank"><img src="<?= Kohana::$base_url; ?>assets/images/icons/social/youtube.png"></a>
<a href="http://www.linkedin.com/company/axes-pro" target="_blank"><img src="<?= Kohana::$base_url; ?>assets/images/icons/social/linkedin.png"></a>
</p>
	</div>
    <div class="half-page">
	<h3>Форма обратной связи</h3><br>
            <form method="post" id="contactForm" class="cmxform">
                <input type="hidden" name="snap_contact" value="<?php echo $snap_contact;?>">
                    <fieldset>
                            <p>
                                    <input type="text" id="cname" value="Имя Фамилия" class="required" name="cname" onblur="if(this.value=='')this.value='Имя Фамилия';" onfocus="if(this.value=='Имя Фамилия')this.value='';">
                            </p>
                            <p>
                                    <input type="text" id="ccompany" value="Компания" class="required" name="ccompany" onblur="if(this.value=='')this.value='Компания';" onfocus="if(this.value=='Компания')this.value='';">
                            </p>
                            <p>
                                    <input type="text" id="cemail" value="Email" class="required email" name="cemail" onblur="if(this.value=='')this.value='Email';" onfocus="if(this.value=='Email')this.value='';">
                            </p>

                            <p>
                                    <textarea id="ccomment" name="ccomment" class="required" rows="10" cols="30" style="width:400px!important;"></textarea>
                            </p>
                    </fieldset>
                    <?php if(isset($recaptcha_contact)):?>
                        <script type="text/javascript"
                           src="https://www.google.com/recaptcha/api/challenge?k=6Lezsu0SAAAAAM7Elqh4GaBAHCQIA_75T-7c84WB">
                        </script>
                    <?php endif;?>
                    <p><button name="sendmail" type="submit" class="btn btn-primary submit">Отправить</button></p>
            </form>
    </div>
	<div class="hrnoline"></div>
        <div class="hr2"></div>
<iframe width="960" height="332" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ru/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=%D0%9D%D0%BE%D0%B2%D0%BE%D1%80%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB+18&amp;aq=&amp;sll=55,103&amp;sspn=59.901604,173.144531&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9D%D0%BE%D0%B2%D0%BE%D1%80%D1%8F%D0%B7%D0%B0%D0%BD%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+18,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0&amp;t=m&amp;ll=55.776814,37.669373&amp;spn=0.016027,0.082312&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
<div class="hrnoline"></div>
<center><img src="<?= Kohana::$base_url; ?>assets/images/qrcontacts.png" alt="AXES Pro QR Contacts"></center>
</div> <!-- end contentwrap -->