var don_huy = document.getElementById('don_hang_huy');
var don_moi = document.getElementById('don_hang_moi');
var don_giao = document.getElementById('don_hang_giao');
var don_xong = document.getElementById('don_hang_xong');
var don_tach = document.getElementById('don_hang_tach');
var btnHuy = document.getElementById("btn__huy");
var btnMoi = document.getElementById("btn__moi");
var btnGiao = document.getElementById("btn__giao");
var btnXong = document.getElementById("btn__xong");
var btnTach = document.getElementById("btn__tach");

    don_huy.style.display = 'none';
    don_moi.style.display = 'none';
    don_giao.style.display = 'none';
    don_xong.style.display = 'block';
    don_tach.style.display = 'none';
    btnXong.style.borderBottom = '3px solid #62F06C';
    btnXong.style.fontSize = '18px';

    function show_huy()
    {
      btnHuy.style.borderBottom = '3px solid #62F06C';
      btnGiao.style.borderBottom = '0';
      btnMoi.style.borderBottom = '0';
      btnXong.style.borderBottom = '0';
      btnHuy.style.fontSize = '18px';
      btnMoi.style.fontSize = '16px';
      btnGiao.style.fontSize = '16px';
      btnXong.style.fontSize = '16px';
     don_huy.style.display = 'block';
	  don_moi.style.display = 'none';
	  don_giao.style.display = 'none';
	  don_xong.style.display = 'none';
      btnTach.style.borderBottom = '0';
         don_tach.style.display = 'none';
          btnTach.style.fontSize = '16px';
    }
    function show_moi()
    {
       btnMoi.style.borderBottom = '3px solid #62F06C';
        btnGiao.style.borderBottom = '0';
       btnHuy.style.borderBottom = '0';
       btnXong.style.borderBottom = '0';
        btnHuy.style.fontSize = '16px';
      btnMoi.style.fontSize = '18px';
      btnGiao.style.fontSize = '16px';
      btnXong.style.fontSize = '16px';
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'block';
	    don_giao.style.display = 'none';
	    don_xong.style.display = 'none';
        btnTach.style.borderBottom = '0';
         don_tach.style.display = 'none';
          btnTach.style.fontSize = '16px';
    }
    function show_giao()
    {
       btnGiao.style.borderBottom = '3px solid #62F06C';
       btnMoi.style.borderBottom = '0';
       btnHuy.style.borderBottom = '0';
       btnXong.style.borderBottom = '0';
        btnHuy.style.fontSize = '16px';
      btnMoi.style.fontSize = '16px';
      btnGiao.style.fontSize = '18px';
      btnXong.style.fontSize = '16px';
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'none';
	    don_giao.style.display = 'block';
	    don_xong.style.display = 'none';
        btnTach.style.borderBottom = '0';
         don_tach.style.display = 'none';
          btnTach.style.fontSize = '16px';
    }
    function show_xong()
    {
       btnXong.style.borderBottom = '3px solid #62F06C';
        btnMoi.style.borderBottom = '0';
       btnHuy.style.borderBottom = '0';
       btnGiao.style.borderBottom = '0';
        btnHuy.style.fontSize = '16px';
      btnMoi.style.fontSize = '16px';
      btnGiao.style.fontSize = '16px';
      btnXong.style.fontSize = '18px';
    	don_huy.style.display = 'none';
	    don_moi.style.display = 'none';
	    don_giao.style.display = 'none';
	    don_xong.style.display = 'block';
       btnTach.style.borderBottom = '0';
         don_tach.style.display = 'none';
          btnTach.style.fontSize = '16px';
    }

      function show_tach()
    {
       btnTach.style.borderBottom = '3px solid #62F06C';
       btnXong.style.borderBottom = '0';
        btnMoi.style.borderBottom = '0';
       btnHuy.style.borderBottom = '0';
       btnGiao.style.borderBottom = '0';
        btnHuy.style.fontSize = '16px';
      btnMoi.style.fontSize = '16px';
      btnGiao.style.fontSize = '16px';
      btnXong.style.fontSize = '16px';
      btnTach.style.fontSize = '18px';
      don_huy.style.display = 'none';
       don_moi.style.display = 'none';
       don_giao.style.display = 'none';
       don_xong.style.display = 'none';
       don_tach.style.display = 'block';
    }