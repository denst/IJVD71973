<?php echo Message::render(); ?>
<!-- Навигация второго уровня-->
<div id="navsec">
    <!--<a class="btn btn-success con ttip" title="Вы добавили 1 запрос" href="#">Отпавить запрос (1)</a>-->
    <h2>Регистрация Летний Клуб Лучших HR Практик</h2>
</div><!-- Конец второй навигации -->

<div id="contentWrap" class="full-width">
    <?php if (count($errors)): ?>
    <div id="msgbox" class="box-error">
        <?php foreach ($errors as $error): ?>
        <?php echo is_array($error) ? implode("<br>", $error) : $error; ?><br>
        <?php endforeach; ?>
    </div>
    <script>
        $(document).ready(function() {
            $("#msgbox").show().delay(5000).fadeOut();
        });
    </script>
    <?php endif; ?>
    <?php if ($success_msg!=""): ?>
    <div id="successbox" class="box-information">
        <?php echo $success_msg; ?><br>
    </div>
    <script>
        $(document).ready(function() {
            $("#successbox").show().delay(5000).fadeOut();
        });
    </script>
    <?php endif; ?>
    <!-- Форма регистрации -->
	
    <div class="half-page">
		<center><img src="http://axes.pro/assets/images/hrclublogo.png" border="0" alt="Клуб Лучших HR Практик" title="Клуб Лучших HR Практик"></center>
        <p>Приглашаем Вас принять участие в Летнем Клубе лучших HR практик. Заседание будет посвящено теме "Graduates. Привлечение. Отбор. Адаптация".</p>
        <p>Как всегда, наши спикеры поделятся с Вами интересными работающими практиками, опытом преодоления трудностей, прогнозами и своими ожиданиями в работе с молодыми специалистами.</p>
		<p><em>7 июня 2013 г. Время проведения 09:40 – 14:30</em></p>
		<h5>Список выступающих</h5>
		<ul class="bullets blue">
			<li>Алена Шевлягина<br><em>Cпециалист Службы Персонала, ГК Видео Интернешнл</em></li>
			<li>Владимир Лавринович<br><em>Руководитель направления оценки и карьерного планирования, Московская Биржа</em></li>
			<li>Людмила Степанова<br><em>Руководитель направления подбора персонала, Московская Биржа</em></li>
			<li>Юлия Тимергалиева<br><em>Менеджер по связям с университетами, General Electric Global Growth & Operations</em></li>
		</ul>
		<p><center><a class="btn btn-large btn-info" href="http://axes.pro/hrclub/summer13/hrclubprogramm-summer13.pdf" target="_blank">Программа клуба</a><br/><br> </center></p>
		<p>Место проведения HR клуба: зал «Нобель» в гостинице «Катерина-Сити». Москва, Шлюзовая набережная д.6</p>
	</div>
    <div class="half-page" style="background:#333;text-align:center;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;padding:13px;">
		<p><center><img src="http://axes.pro/hrclub/summer13/hrclub-summer-t1.png"></center></p>
        <h4 style="color:#C99A2C;text-shadow: 0px 1px 0px #000;">Форма регистрации</h4>
		<h5 style="color:#fff;">Заполните все поля ниже и нажмите на кнопку &laquo;Регистрация&raquo;</h5>
        <form method="post" action="#">
            <fieldset>
                <p><input type="text" onfocus="if(this.value=='Имя')this.value='';" onblur="if(this.value=='')this.value='Имя';" name="firstname" class="required" value="<?php echo @$_POST['firstname'] ? @$_POST['firstname'] : "Имя";?>" id="cfirstname"/></p>
                <p><input type="text" onfocus="if(this.value=='Фамилия')this.value='';" onblur="if(this.value=='')this.value='Фамилия';" name="lastname" class="required" value="<?php echo @$_POST['lastname'] ? @$_POST['lastname'] : "Фамилия";?>" id="clastname" /></p>
                <p><input type="text" onfocus="if(this.value=='Компания')this.value='';" onblur="if(this.value=='')this.value='Компания';" name="company" class="required" value="<?php echo @$_POST['company'] ? @$_POST['company'] : "Компания";?>"  id="ccompany"/></p>
                <p><input type="text" onfocus="if(this.value=='Должность')this.value='';" onblur="if(this.value=='')this.value='Должность';" name="post" class="required" value="<?php echo @$_POST['post'] ? @$_POST['post'] : "Должность";?>" id="cpost"/></p>
                <p><input type="text" onfocus="if(this.value=='E-mail')this.value='';" onblur="if(this.value=='')this.value='E-mail';" name="email" class="required email" value="<?php echo @$_POST['email'] ? @$_POST['email'] : "E-mail";?>" id="cemail" /></p>
                <p><input type="text" onfocus="if(this.value=='Телефон')this.value='';" onblur="if(this.value=='')this.value='Телефон';" name="telephone" class="required" value="<?php echo @$_POST['telephone'] ? @$_POST['telephone'] : "Телефон";?>" id="ctelephone"/></p>
            </fieldset>
            <button type="submit" class="btn btn-primary">Регистрация</button>
        </form>
    </div>
    <!-- Конец формы регистрации -->
    <div class="clearfix"></div>
</div> <!-- end contentwrap -->
