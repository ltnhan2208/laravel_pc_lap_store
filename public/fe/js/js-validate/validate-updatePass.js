// Validation Login Register updatePass
   function onPass1(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass").value;
         var ip_old_pass_css = document.getElementById("cont__pass");
         var err_pass = document.getElementById("old__pass--err");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu không được quá ngắn(ít nhất 8 kí tự)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }
     function onPass2(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass2").value;
         var ip_old_pass_css = document.getElementById("cont__pass2");
         var err_pass = document.getElementById("old__pass--err2");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu mới không được quá ngắn(ít nhất 8 kí tự)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }
    function onPass3(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass3").value;
         var ip_old_pass_css = document.getElementById("cont__pass3");
         var err_pass = document.getElementById("old__pass--err3");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu nhập lại phải trùng với mật khẩu vừa mới)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }

    function btnLogin()
    {
      var ip_old_pass = document.getElementById("cont__pass").value;
      var ip_pass = document.getElementById("cont__pass").value;
       if(ip_old_pass.length<8||ip_pass.length<8)
       {
        btn_update.setAttribute("type","button");
       }
       else {
         btn_update.setAttribute("type","submit");
       }
    }



    //đổi pass 1
var pass = document.getElementById("cont__pass");
var click = document.getElementById("click__pass");
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

document.getElementById("click__pass").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        showPass();
    } else {
        pwShown = 0;
        hidePass();
    }
}, false);

// nhập lại đổi pass 1
var pass2 = document.getElementById("cont__pass2");
var click2 = document.getElementById("click__pass2");
function showPass2()
{
    click2.setAttribute("class","far fa-eye-slash");
  pass2.setAttribute("type","text");
}
function hidePass2()
{
  pass2.setAttribute("type","password");
    click2.setAttribute("class","far fa-eye");
}
var pwShown2 = 0;

click2.addEventListener("click", function () {
    if (pwShown2 == 0) {
        pwShown2 = 1;
        showPass2();
    } else {
        pwShown2 = 0;
        hidePass2();
    }
}, false);

// nhập lại đổi pass 2 
var pass3 = document.getElementById("cont__pass3");
var click3 = document.getElementById("click__pass3");
pass.setAttribute("type","password");
function showPass3()
{
    click3.setAttribute("class","far fa-eye-slash");
  pass3.setAttribute("type","text");
}
function hidePass3()
{
    click3.setAttribute("class","far fa-eye");
  pass3.setAttribute("type","password");
}
var pwShown3 = 0;

click3.addEventListener("click", function () {
    if (pwShown3 == 0) {
        pwShown3 = 1;
        showPass3();
    } else {
        pwShown3 = 0;
        hidePass3();
    }
}, false);
