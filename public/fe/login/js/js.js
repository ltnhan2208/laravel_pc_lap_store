 /* Password */
  var passDK = document.getElementById("password");
  var showEye = document.getElementById("show__pass1");
  passDK.setAttribute("type", "password");
  function showPassDK()
  {
    var pass = document.getElementById("password");
    var showEye = document.getElementById("show__pass1");
    showEye.setAttribute("class", "far fa-eye-slash");
    pass.setAttribute("type", "text");
  }
  function hidePassDK()
  {
    var pass = document.getElementById("password");
    var showEye = document.getElementById("show__pass1");
    showEye.setAttribute("class", "far fa-eye");
    pass.setAttribute("type", "password");
  }
  var countPass = 0;
  showEye.addEventListener("click", function(){
    if(countPass == 0)
    {
      countPass=1;
      showPassDK();
    }
    else{
      countPass=0;
      hidePassDK();
    }
  }, false);


  /* Repasssword */
  var repass = document.getElementById("repassword");
  var showEye2 = document.getElementById("show__pass2");
  repass.setAttribute("type", "password");
  function showRePassDK()
  {
    var repass = document.getElementById("repassword");
    var showEye = document.getElementById("show__pass2");
    showEye.setAttribute("class", "far fa-eye-slash");
    repass.setAttribute("type", "text");
  }
  function hideRePassDK()
  {
    var repass = document.getElementById("repassword");
    var showEye = document.getElementById("show__pass2");
    showEye.setAttribute("class", "far fa-eye");
    repass.setAttribute("type", "password");
  }
  var countPass2 = 0;
  showEye2.addEventListener("click", function(){
    if(countPass2 == 0)
    {
      countPass2=1;
      showRePassDK();
    }
    else{
      countPass2=0;
      hideRePassDK();
    }
  }, false);



  
  