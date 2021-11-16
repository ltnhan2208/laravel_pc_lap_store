////Sửa
  var lap = document.getElementById('sua_lap');
  var pc = document.getElementById('sua_pc');
  var loai = document.getElementById('loai');
 
 if(lap!=null && pc!=null && loai != null)
 {
    if(loai.value==1)
  {
    lap.style.display = 'block';
    pc.style.display = 'none';
  }
  else
  {
      lap.style.display = 'none';
      pc.style.display = 'block';
  }
  function change2()
  {
     if(loai.value==1)
  {
    lap.style.display = 'block';
    pc.style.display = 'none';
  }
  else
  {
      lap.style.display = 'none';
      pc.style.display = 'block';
  }
  }
 }



  