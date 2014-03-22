<link href="/formbuilder/css/custom.css" rel="stylesheet">
<script>
$(document).ready(function(){
    $("#save_form").click(function(){
        var elements_info = [];
        
        function setElementInfo(){
            setInputInfo('input-control', 'input');
            setSelectInfo('radio-control', 'input', 'radio-button');
            setSelectInfo('checkbox-control', 'input', 'checkbox');
            setSelectInfo('select-control', 'select', 'select');
            setSelectInfo('slider-container', 'input', 'slider');
            setInputInfo('textarea-control', 'textarea');
        }
        
        function setInputInfo(pathElement, typeElement){
            $("#target ." + pathElement).each(function(){
                var input = $(this).find(typeElement);
                if(input.attr('type') === 'file')
                    setInfo('File', typeElement, input.attr("id"));
                else
                    setInfo(input.val(), typeElement, input.attr("id"));
            });
        }
        
        function setSelectInfo(pathElement, findElement, typeElement){
            $("#target ." + pathElement).each(function(){
                var title_element = $(this).find("h4").html();
                if(title_element.indexOf(':') != -1){
                    title_element = title_element.substring(0, title_element.indexOf(':'))
                }

                var id_element = $(this).find(findElement).attr("name");
                id_element = id_element.replace("[",'');
                id_element = id_element.replace("]",'');
                setInfo(title_element, typeElement, id_element);
            });
        }
        
        function setInfo(title_element, type_element, id_element){
            elements_info.push([title_element, type_element, id_element]);
        }
        
        setElementInfo();
        $('input[name="title"]').val($("#build h3").html());
        $('input[name="description"]').val($("#build #description").val());
        $('input[name="body"]').val($("#render").val());
        $('input[name="info"]').val(JSON.stringify(elements_info));
        $("#created_form").submit();
    });
});
</script>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<form id="created_form" action="<?php echo URL::base()?>admin/formbuilder/add" method="POST">
    <input type="hidden" name="title" value="">
    <input type="hidden" name="description" value="">
    <input type="hidden" name="body" value="">
    <input type="hidden" name="info" value="">
</form>
<div id="block_save_form">
    <!--<button id="save_form" class="btn btn-primary" disabled="disabled">Сохранить форму</button>-->
    <button id="save_form" class="btn btn-primary" >Сохранить форму</button>
</div>
<br />
<!--<pre><b>Заметка:</b><b class="necessary">* </b> Обязательные поля</pre>-->
<div class="row clearfix">
  <!-- Building Form. -->
    <div class="span6">
        <div class="clearfix">
          <h2>Форма</h2>
          <hr>
          <div id="build">
              <form id="target" action="" class="form-horizontal" method="POST">
              </form>
          </div>
        </div>
    </div>
    <!-- / Building Form. -->

    <!-- Components -->
    <div class="span6">
      <h2>Перетащите нужные компоненты</h2>
      <hr>
      <div class="tabbable">
        <ul class="nav nav-tabs" id="formtabs">
          <!-- Tab nav -->
        </ul>
        <form class="form-horizontal" id="components">
          <fieldset>
            <div class="tab-content">
              <!-- Tabs of snippets go here -->
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  <!-- / Components -->

</div>
<script data-main="/formbuilder/js/main-built.js" src="/formbuilder/js/lib/require.js" ></script>
