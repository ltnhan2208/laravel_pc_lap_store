//name
function onName()
{
	var ip_name = document.getElementById("ip__name");
	var ip_name_val = document.getElementById("ip__name").value;
	var name_err_regis = document.getElementById("name__err--regis");
	name_err_regis.style.display = 'none';
	var btnRegis = document.getElementById("btn__register")
	 if(ip_name_val.trim().length<8)
	 {
	 	ip_name.style.border = '2px solid red';
	 	name_err_regis.style.display = 'block';
	 	name_err_regis.innerHTML = "Tên không được dưới 8 ký tự";
	 	name_err_regis.style.color = 'red';
	 	btnRegis.setAttribute("type", "button");
	 }
	 else {
	 	ip_name.style.border = '2px solid green';
	 	name_err_regis.style.display = 'none';
	 	name_err_regis.innerHTML = "";
	 	
	 	btnRegis.setAttribute("type", "submit");
	 }
}
//Account
function onAcc()
{
	var ip_acc = document.getElementById("ip__acc");
	var ip_acc_val = document.getElementById("ip__acc").value;
	var acc_err_regis = document.getElementById("acc__err--regis");
	acc_err_regis.style.display = 'none';
	var btnRegis = document.getElementById("btn__register")
	 if(ip_acc_val.trim().length<4)
	 {
	 	ip_acc.style.border = '2px solid red';
	 	acc_err_regis.style.display = 'block';
	 	acc_err_regis.innerHTML = "Tài khoản phải từ 4 ký tự trở lên";
	 	acc_err_regis.style.color = 'red';
	 	btnRegis.setAttribute("type", "button");
	 }
	 else {
	 	ip_acc.style.border = '2px solid green';
	 	acc_err_regis.style.display = 'none';
	 	acc_err_regis.innerHTML = "";
	 	
	 	btnRegis.setAttribute("type", "submit");
	 }
}

//password
function onPass1(){
        //cont__pass
         var ip_pass = document.getElementById("password").value;
         var ip_pass_css = document.getElementById("password");
         var err_pass = document.getElementById("pass__err");
         err_pass.style.display = 'none';
        //btn_regis
         var btn_regis = document.getElementById("btn__register");
        if(ip_pass.trim().length<8)
          {
            err_pass.style.color = 'red';
            ip_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu mới không được quá ngắn(ít nhất 8 kí tự)";
            btn_regis.setAttribute("type","button");
          }
          else { 
             ip_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_regis.setAttribute("type","submit");
          }  
    }
   //repassword
   function onPass2(){
        //cont__pass
         var ip_pass = document.getElementById("repassword").value;
         var ip_pass_css = document.getElementById("repassword");
         var err_pass = document.getElementById("pass__err2");
         err_pass.style.display = 'none';
        //btn_regis
         var btn_regis = document.getElementById("btn__register");
        if(ip_pass.trim().length<8)
          {
            err_pass.style.color = 'red';
            ip_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu nhập lại không được quá ngắn(ít nhất 8 kí tự)";
            btn_regis.setAttribute("type","button");
          }
          else { 
             ip_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_regis.setAttribute("type","submit");
          }  
    }

    //Địa chỉ
   function onAddress(){
        //cont__pass
         var ip_address = document.getElementById("address").value;
         var ip_address_css = document.getElementById("address");
         var err_address = document.getElementById("address__err--regis");
         err_address.style.display = 'none';
        //btn_regis
         var btn_regis = document.getElementById("btn__register");
        if(ip_address.trim().length<10)
          {
            err_address.style.color = 'red';
            ip_address_css.style.border= '3px solid red';
            err_address.style.display = 'block';
            err_address.innerHTML="&emsp;Địa chỉ không hợp lệ";
            btn_regis.setAttribute("type","button");
          }
          else { 
             ip_address_css.style.border= '3px solid green';
             err_address.style.display = 'none';
             err_address.innerHTML="";
             btn_regis.setAttribute("type","submit");
          }  
    }

     //sdt
   function onSDT(){
        //cont__pass
         var ip_sdt = document.getElementById("sdt").value;
         var ip_sdt_css = document.getElementById("sdt");
         var err_sdt = document.getElementById("sdt__err--regis");
        //btn_regis
         var btn_regis = document.getElementById("btn__register");
         if(ip_sdt.length==10 || ip_sdt.length==11)
          {
            ip_sdt_css.style.border= '3px solid green';
             err_sdt.style.display = 'none';
             err_sdt.innerHTML="";
             btn_regis.setAttribute("type","submit");
          }
          else
          {
             ip_sdt_css.style.border= '3px solid red';
             err_sdt.style.display = 'block';
             err_sdt.innerHTML="Số điện thoại không hợp lệ!";
             btn_regis.setAttribute("type","button");
          }
    }







//đổi pass 1
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

click.addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        showPass();
    } else {
        pwShown = 0;
        hidePass();
    }
}, false);

    // nhập lại đổi pass 1
    var pass2 = document.getElementById("repassword");
    var click2 = document.getElementById("show__pass2");
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