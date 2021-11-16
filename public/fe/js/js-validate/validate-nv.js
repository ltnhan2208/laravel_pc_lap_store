//name
function onName()
{
	var ip_name = document.getElementById("ip__name");
	var ip_name_val = document.getElementById("ip__name").value;
	var name_err_update = document.getElementById("name__err--update");
	name_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_name_val.trim().length<5)
	 {
	 	ip_name.style.border = '2px solid red';
	 	name_err_update.style.display = 'block';
	 	name_err_update.innerHTML = "Tên nhân viên không được dưới 5 ký tự";
	 	name_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_name.style.border = '2px solid green';
	 	name_err_update.style.display = 'none';
	 	name_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}

//acc
function onAcc()
{
	var ip_acc = document.getElementById("ip__acc");
	var ip_acc_val = document.getElementById("ip__acc").value;
	var acc_err_update = document.getElementById("acc__err--update");
	acc_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_acc_val.trim().length<4)
	 {
	 	ip_acc.style.border = '2px solid red';
	 	acc_err_update.style.display = 'block';
	 	acc_err_update.innerHTML = "Tai khoản viên không được dưới 4 ký tự";
	 	acc_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_acc.style.border = '2px solid green';
	 	acc_err_update.style.display = 'none';
	 	acc_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}
//pass
function onPass()
{
	var ip_pass = document.getElementById("ip__pass");
	var ip_pass_val = document.getElementById("ip__pass").value;
	var pass_err_update = document.getElementById("pass__err--update");
	pass_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_pass_val.trim().length<8)
	 {
	 	ip_pass.style.border = '2px solid red';
	 	pass_err_update.style.display = 'block';
	 	pass_err_update.innerHTML = "Mật khẩu không được dưới 8 ký tự";
	 	pass_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_pass.style.border = '2px solid green';
	 	pass_err_update.style.display = 'none';
	 	pass_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}

//sdt
function onSdt()
{
	var ip_sdt = document.getElementById("ip__sdt");
	var ip_sdt_val = document.getElementById("ip__sdt").value;
	var sdt_err_update = document.getElementById("sdt__err--update");
	sdt_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_sdt_val.trim().length<=9 || ip_sdt_val.trim().length>11||ip_sdt_val < 0)
	 {
	 	ip_sdt.style.border = '2px solid red';
	 	sdt_err_update.style.display = 'block';
	 	sdt_err_update.innerHTML = "Số điện thoại không hợp lệ";
	 	sdt_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_sdt.style.border = '2px solid green';
	 	sdt_err_update.style.display = 'none';
	 	sdt_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}

//cmnd
function onCmnd()
{
	var ip_cmnd = document.getElementById("ip__cmnd");
	var ip_cmnd_val = document.getElementById("ip__cmnd").value;
	var cmnd_err_update = document.getElementById("cmnd__err--update");
	cmnd_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_cmnd_val.length<=5 || ip_cmnd_val.length>10)
	 {
	 	ip_cmnd.style.border = '2px solid red';
	 	cmnd_err_update.style.display = 'block';
	 	cmnd_err_update.innerHTML = "Số chứng minh không đúng";
	 	cmnd_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else if(ip_cmnd_val == "")
	 {
	 ip_cmnd.style.border = '2px solid red';
	 	cmnd_err_update.style.display = 'block';
	 	cmnd_err_update.innerHTML = "Số chứng minh không được rỗng";
	 	cmnd_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_cmnd.style.border = '2px solid green';
	 	cmnd_err_update.style.display = 'none';
	 	cmnd_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}

//Địa chỉ
function onDiachi()
{
	var ip_diachi = document.getElementById("ip__diachi");
	var ip_diachi_val = document.getElementById("ip__diachi").value;
	var diachi_err_update = document.getElementById("diachi__err--update");
	diachi_err_update.style.display = 'none';
	var btnOk = document.getElementById("btn__ok")
	 if(ip_diachi_val<=15)
	 {
	 	ip_diachi.style.border = '2px solid red';
	 	diachi_err_update.style.display = 'block';
	 	diachi_err_update.innerHTML = "Địa chỉ không đúng";
	 	diachi_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else if(ip_diachi_val == "")
	 {
	 ip_diachi.style.border = '2px solid red';
	 	diachi_err_update.style.display = 'block';
	 	diachi_err_update.innerHTML = "Địa chỉ không được rỗng";
	 	diachi_err_update.style.color = 'red';
	 	btnOk.setAttribute("type", "button");
	 }
	 else {
	 	ip_diachi.style.border = '2px solid green';
	 	diachi_err_update.style.display = 'none';
	 	diachi_err_update.innerHTML = "";
	 	
	 	btnOk.setAttribute("type", "submit");
	 }
}

