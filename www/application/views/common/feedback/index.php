<div id="navsec">
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>
    
    <h2><?php echo $page->title; ?></h2>
</div>

<?php if (isset($_message)): ?>
    <div id="msgbox" class="box-information"><?php echo $_message; ?></div>
    <script>
        $(document).ready(function() {
            $("#msgbox").show().delay(6000).fadeOut();
        });
    </script>
<?php endif; ?>

<div id="contentWrap" class="full-width">
    <div class="half-page">
            <form method="post" id="contactForm" class="cmxform" enctype="multipart/form-data">
                    <fieldset>
                            <p>
                                    <input type="text" id="ccompany" value="Компания" class="required" name="ccompany" onblur="if(this.value=='')this.value='Компания';" onfocus="if(this.value=='Компания')this.value='';">
                            </p>
                            <p>
                                    <input type="text" id="cname" value="Фамилия Имя Отчество" class="required" name="cname" onblur="if(this.value=='')this.value='Фамилия Имя Отчество';" onfocus="if(this.value=='Фамилия Имя Отчество')this.value='';">
                            </p>
                            <p>
                                    <input type="text" id="cemail" value="Email" class="required email" name="cemail" onblur="if(this.value=='')this.value='Email';" onfocus="if(this.value=='Email')this.value='';">
                            </p>
                            <p>
                                    <input type="text" id="cposition" value="Должность" class="required" name="cposition" onblur="if(this.value=='')this.value='Должность';" onfocus="if(this.value=='Должность')this.value='';">
                            </p>
                            <p>
                                    <textarea id="ccomment" name="ccomment" class="required" rows="10" cols="30"></textarea>
                            </p>
                            <p>
                                    <input type="file" id="cfile" name="cfile">
                            </p>
                    </fieldset>
                    <p><button name="sendmail" type="submit" class="btn btn-primary submit">Отправить</button></p>
            </form>
    </div>
    <div class="clearfix"></div>
</div>