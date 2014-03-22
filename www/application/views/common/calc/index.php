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

<link type="text/css" href="<?php echo URL::base();?>media/css/ui-lightness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />

<div id="contentWrap" class="full-width">
    <div class="half-page">
            <form method="post" id="contactForm" class="cmxform" enctype="multipart/form-data">
                    <fieldset id="step1">
                            <p>
                                <div id="amount" style='padding-bottom: 5px;'><h4>Численность компании: 250</h4></div>
                                <div id="slider-range" style="width: 300px; margin-bottom: 20px"></div>
                                <input type='hidden' name='count' value='250' id="count"/>
                                
                                <script type="text/javascript">
                                    $(function() {
                                        var valMap = [250, 1000, 5000, 25000, 100000];
                                        $("#slider-range").slider({
                                            min: 0,
                                            max: valMap.length - 1,
                                            slide: function(event, ui) {                        
                                                $("#amount").html('<h4>Численность компании: ' + valMap[ui.value] + '</h4>');
                                                $("#count").val(valMap[ui.value]);
                                            }       
                                        });
                                    });
                                </script>
                            </p>
                            <p>
                                <div>
                                    <h4>Модули Lumesse ETWeb</h4>
                                    <?php foreach (Helper_Default::get_by_type(2) as $key => $value): ?>
                                        <p><label for="calc_<?php echo $key; ?>"><input name="calc_<?php echo $key; ?>" id="calc_<?php echo $key; ?>" value="1" type="checkbox"><?php echo $value; ?></label></p>
                                    <?php endforeach; ?>
                                </div>
                            </p>
                            <p>
                                <div>
                                    <h4>Вариант приобретения</h4>
                                    <input type="radio" name="type" value='аренда лицензии' checked>аренда лицензии<br>
                                    <input type="radio" name="type" value='покупка'>покупка
                                </div>
                            </p>
                    </fieldset>
                    <fieldset id="step2" style="display: none">
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
                    <p>
                        <button class="btn btn-info" onclick="return false;" id='gotoStep2'>Перейти к Шагу №2</button>
                        <button class="btn btn-info" onclick="return false;" id='gotoStep1' style='display: none;'>Вернуться к Шагу №1</button>
                        <button class="btn btn-primary submit" id='gotoSubmit' style='display: none;'>Отправить</button>
                    </p>
            </form>
    </div>
    <div class="clearfix"></div>
</div>

<script type="text/javascript">
    $("#gotoStep2").click(function() {
        $(this).hide();
        $('#gotoStep1').show();
        $('#gotoSubmit').show();
        
        $('#step1').hide();
        $('#step2').show();
    });
    $("#gotoStep1").click(function() {
        $(this).hide();
        $('#gotoSubmit').hide();
        $('#gotoStep2').show();
        
        $('#step2').hide();
        $('#step1').show();
    });
</script>