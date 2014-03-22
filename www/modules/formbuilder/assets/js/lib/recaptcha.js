recaptcha = {
    
    checkRecaptcha: function(){
         $.ajax({
            type: "POST",
            url: "/form/checkrecaptcha",
            dataType: "json",
            success: function(data){
               if(data.success == true && data.show_recaptcha == true) {
                   $('#captcha-container').css('display', 'block');
                   $('<input>').attr({
                       type: 'hidden',
                       name: 'enable_recaptcha',
                       value: 'true'
                   }).appendTo('#formConversion1');
               }
           }
        });
    }
}
$(function(){
    recaptcha.checkRecaptcha();
});