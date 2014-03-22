<div id="navsec">
    <?php if (!$c = count(Model_Cart::get_cart())): ?>
    <a id="btn-order" class="btn btn-primary con ttip" href="javascript:void(0);">Отправить запрос</a>
    <?php else: ?>
    <a id="btn-order" class="btn btn-success con ttip" href="javascript:void(0);" original-title="Вы добавили <?php echo $c; ?> запрос(ов)">Отправить запросы (<?php echo $c; ?>)</a>
    <?php endif; ?>
    
    <h2><?php echo $page->title; ?>: Шаг №2</h2>
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
                                <input onfocus="if(this.value=='Фамилия Имя Отчество')this.value='';" onblur="if(this.value=='')this.value='Фамилия Имя Отчество';" name="cname" class="required" value="Фамилия Имя Отчество" id="cname" type="text"/>
                            </p>
                            <p>
                                <input onfocus="if(this.value=='E-mail')this.value='';" onblur="if(this.value=='')this.value='E-mail';" name="cemail" class="required email" value="E-mail" id="cemail" type="text"/>
                            </p>
                            <p>
                                <input onfocus="if(this.value=='Телефон')this.value='';" onblur="if(this.value=='')this.value='Телефон';" name="cphone" class="required" value="Телефон" id="cphone" type="text"/>
                            </p>
                            <p>
                                <input onfocus="if(this.value=='Компания')this.value='';" onblur="if(this.value=='')this.value='Компания';" name="ccompany" class="required" value="Компания" id="ccompany" type="text"/>
                            </p>                        
                    </fieldset>
                    <p><button name="sendmail" type="submit" class="btn btn-primary submit">Отправить</button></p>
            </form>
    </div>
    <div class="clearfix"></div>
</div>