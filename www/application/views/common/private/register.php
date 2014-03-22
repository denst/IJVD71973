<div id="navsec">
    <h2>Регистрация</h2>

</div>

<div id="contentWrap">
    <div id="content">
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
        <form style="margin-left:350px;" action="#" method="post">
            <fieldset>
                <p><input type="text" id="cemail" value="<?php echo @$_POST['email'] ? @$_POST['email'] : "E-mail";?>" class="required email" name="email" onblur="if(this.value=='')this.value='E-mail';" onfocus="if(this.value=='E-mail')this.value='';"></p>
                <p><input type="text" id="cusername" value="<?php echo @$_POST['username'] ? @$_POST['username'] : "Логин";?>" class="required email" name="username" onblur="if(this.value=='')this.value='Логин';" onfocus="if(this.value=='Логин')this.value='';"></p>
                <p><input type="text" id="cfirstname" value="<?php echo @$_POST['firstname'] ? @$_POST['firstname'] : "Имя";?>" class="required" name="firstname" onblur="if(this.value=='')this.value='Имя';" onfocus="if(this.value=='Имя')this.value='';"></p>
                <p><input type="text" id="clastname" value="<?php echo @$_POST['lastname'] ? @$_POST['lastname'] : "Фамилия";?>" class="required" name="lastname" onblur="if(this.value=='')this.value='Фамилия';" onfocus="if(this.value=='Фамилия')this.value='';"></p>
                <p><input type="password" id="cpassword" value="" title="Введите пароль" class="required ttip" name="password" onblur="if(this.value=='')this.value='Пароль';" onfocus="if(this.value=='Пароль')this.value='';"></p>
                <p><input type="password" id="cpassword_repeat" value="" title="Повторите пароль" class="required ttip" name="password_confirm" onblur="if(this.value=='')this.value='Повторите пароль';" onfocus="if(this.value=='Повторите пароль')this.value='';"></p>
            </fieldset>
            <button class="btn btn-primary" type="submit">Регистрация</button>
        </form>
    </div> <!-- end content -->
    <div class="clearfix"></div>
</div>
