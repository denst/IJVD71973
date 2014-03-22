<div id="navsec">
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
            <form method="post" action="" enctype="multipart/form-data" onsubmit="return check_con_form();" >
                <div class="box-error" style="display:none;"></div>
                <?php echo Form::hidden('con', '1'); ?>
                <fieldset>
                    <p>
                        <input onfocus="if(this.value=='Имя')this.value='';" onblur="if(this.value=='')this.value='Имя';" name="cname" class="required" value="Имя" id="cname" type="text"/>
                        <input onfocus="if(this.value=='Фамилия')this.value='';" onblur="if(this.value=='')this.value='Фамилия';" name="clastname" class="required" value="Фамилия" id="clastname" type="text"/>
                    </p>
                    <p>
                        <input onfocus="if(this.value=='E-mail')this.value='';" onblur="if(this.value=='')this.value='E-mail';" name="cemail" class="required email" value="E-mail" id="cemail" type="text"/>
                        <input onfocus="if(this.value=='Телефон')this.value='';" onblur="if(this.value=='')this.value='Телефон';" name="cphone" class="required" value="Телефон" id="cphone" type="text"/></p>
                    <p>
                        <input onfocus="if(this.value=='Компания')this.value='';" onblur="if(this.value=='')this.value='Компания';" name="ccompany" class="required" value="Компания" id="ccompany" type="text"/>
                        <select name="theme">
                            <option disabled="disabled">Выберите вид заявки</option>
                            <?php foreach (Kohana::$config->load('default.conversion_types') as $key=>$value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select></p>
                    <div class="checkit">
                        <?php $cart = Model_Cart::get_cart_ids(); ?>
                        <h4>Услуги  решения</h4>
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
                    <textarea cols="30" rows="10" class="required" name="ccomment" id="ccomment" style="width:950px;"></textarea>
                </fieldset>
                <button type="submit" class="btn btn-primary">Отправить запрос</button>
            </form>
    </div>
    <div class="clearfix"></div>
</div>