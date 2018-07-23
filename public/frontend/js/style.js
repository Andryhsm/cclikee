/****** CSS MANIPULATION *****/
    $('#content-cart').css('left', "-600px");
    $('#content-cart').css('width', '500px;');
    console.log("Un autre bonjour ! ");

     if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        $('.sell_coeur').css('margin-top', '-10px !important');
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
         $('.sell_coeur').css('margin-top', '0px !important');
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      
    }  
    
