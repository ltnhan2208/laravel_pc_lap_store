var show_boxAddress = document.getElementById("show__boxAddress");
//var hide_boxAddress = document.getElementById("hide__boxAddress");
var box_address =  document.getElementById("update__address");
 box_address.style.height = '0';
 box_address.style.transform = 'scaleY(0)';
 box_address.style.transformOrigin = '100% 0';

var countBox = 0;

show_boxAddress.addEventListener("click", function(){
    if(countBox == 0)
    {
        countBox=1;
        var box_address =  document.getElementById("update__address");
        box_address.style.height = 'auto';
        box_address.style.transform = 'scaleY(1)';
        box_address.style.transition = '0.5';
       // hide_boxAddress.style.opacity  = '100%';
    }
    else {
        countBox=0;
        var box_address =  document.getElementById("update__address");
        box_address.style.height = '0';
         box_address.style.transform = 'scaleY(0)';
        box_address.style.transition = '0.5s';
        // hide_boxAddress.style.opacity  = '100%';
    }
    },false);

    // hide_boxAddress.addEventListener("click", function(){
    //         countBox = 0;
    //         var box_address =  document.getElementById("update__address");
    //         box_address.style.height = '0';
    //         box_address.style.transform = 'scaleY(0)';
    //         box_address.style.transition = '0.5s';
    //         hide_boxAddress.style.opacity  = '0%';
    // });




  
