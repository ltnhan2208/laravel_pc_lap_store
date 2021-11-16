// Validation Login Register updatePass
   function onUser(){
        //username
         var ip_acc = document.getElementById("username").value;
         var ip_acc_css = document.getElementById("username");
         var err_acc = document.getElementById("acc__err--login");
         err_acc.style.display = 'none';
        //btn_login
         var btn_login = document.getElementById("btn__login");
        if(ip_acc.trim().length<3)
          {
            err_acc.style.color = 'red';
            ip_acc_css.style.border= '3px solid red';
            err_acc.style.display = 'block';
            err_acc.innerHTML="&emsp;Độ dài ký tự không được nhỏ hơn 3";
            btn_login.setAttribute("type","button");
          }
          else { 
             ip_acc_css.style.border= '3px solid green';
             err_acc.style.display = 'none';
             err_acc.innerHTML="";
             btn_login.setAttribute("type","submit");
          }  
    }

    function onPass()
    {
       //password
         var ip_pass = document.getElementById("password").value;
         var ip_pass_css = document.getElementById("password");
         var err_pass = document.getElementById("pass__err--login");
          err_pass.style.display = 'none';
        //btn_login
         var btn_login = document.getElementById("btn__login");
         
       if(ip_pass.trim().length<8)
          {
            err_pass.style.color = 'red';
            ip_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu không được nhỏ hơn 8";
            btn_login.setAttribute("type","button");
          }
          else { 
            ip_pass_css.style.border= '3px solid green';
            err_pass.style.display = 'none';
            err_pass.innerHTML="";
            btn_login.setAttribute("type","submit");
          }
    }

    function btnLogin()
    {
      var ip_acc = document.getElementById("username").value;
       var ip_pass = document.getElementById("password").value;
       if(ip_acc.length<3||ip_pass.length<3)
       {
        btn_login.setAttribute("type","button");
       }
       else {
         btn_login.setAttribute("type","submit");
       }
    }






    //LOGIN ADMIN//
        var pass = document.getElementById("password");
        var click = document.getElementById("show__pass1");
        function showPass()
        {
            click.setAttribute("class","far fa-eye-slash");
            pass.setAttribute("type","text");
        }
        function hidePass()
        {
            click.setAttribute("class","far fa-eye");
            pass.setAttribute("type","password");
        }
        var pwShown = 0;
        click.addEventListener("click", function (){
            if (pwShown == 0) {
                pwShown = 1;
                showPass();
            } else {
                pwShown = 0;
                hidePass();
            }
        });


 var idpass = document.getElementById("password");
    idpass.onchange=function(){
        //password
         var ip_pass = document.getElementById("password").value;
         var ip_pass_css = document.getElementById("password");
         var err_pass = document.getElementById("pass__err--login");
          err_pass.style.display = 'none';
        //btn_login
         var btn_login = document.getElementById("btn__login");
         
       if(ip_pass.trim().length<8)
          {
            err_pass.style.color = 'red';
            ip_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu không được nhỏ hơn 8";
            btn_login.setAttribute("type","button");
          }
          else { 
            ip_pass_css.style.border= '3px solid green';
            err_pass.style.display = 'none';
            err_pass.innerHTML="";
            btn_login.setAttribute("type","submit");
          }
    };
