var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
validation = {
    
    checkSubmitData: function(){
        $('button[id="send"]').click(function(e){
            e.preventDefault();
            var is_error = false;
            var form = $(this).parent().parent()
            form.find(".input-control input.required").each(function(){
                var input = $(this);
                
                if(input.attr("name") == "phone" && $('input[name="phone"]').val().length > 0){
                    var phoneNumeric = 0;
                    var value = $('input[name="phone"]').val();
                    for(var i = 0; i < value.length; i++){
                        if(! isNaN(parseInt(value[i])))
                            phoneNumeric++;
                    }
                }
                
                if(input.val() == "" || 
                        input.val() === input.attr("placeholder") ||
                         (phoneNumeric !== 'undefined' && phoneNumeric < 11)){
                    
                    if(input.attr("name") == "phone" && input.val() === input.attr("placeholder")){
                    }
                    else{
                        var error = $(input).parent().next();
                        error.html("Поле является обязательным").show();
                        $(input).addClass("error");
                        is_error = true;
                    }
                }
            });
            if(! is_error)
                form.submit();
        });
    },
    
    setPhoneValidation: function(){
       $("#phone").inputmask("mask", {"mask": "+9 (999) 999-99-99"}); //specifying fn & options
    },
    
    checkInputs: function(){
        $('input[type="text"]').keypress(function(){
            $(this).removeClass('error');
            $(this).parent().next().hide();
        });
        $('input[type="text"]').blur(function(){
            if($(this).val().length > 100){
                var error = $(this).parent().next();
                error.html("Текст поля не может превышать 100 символов").show();
                $(this).addClass("error");
            }
        });
    },
    
    checkMail: function(){
      var mail = $('#email');
      mail.keypress(function(){
         $(this).removeClass('error');
         $(".email-error").hide();
      });
      mail.blur(function(){
          if(mail.val() != ''){
              if(mail.val().search(pattern) != 0){
                  var error = $(".email-error");
                  error.html("Неправильный формат еmail").show();
                  mail.addClass("error");
              }
          }
      });
    }
}
$(function(){
    validation.checkMail();
    validation.checkInputs();
    validation.setPhoneValidation();
    validation.checkSubmitData();
});
