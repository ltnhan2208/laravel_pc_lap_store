 //ajax search thống kế 
       $(document).on('click','#btnSearch',function(e){
         e.preventDefault();
       $.ajax({
        type:"POST",
        cache:false,
        url:'searchThongke',
        dataType:'JSON',
        data:$("#formTime").serialize(),
        success:function(response){
            result = response.message;
           if(result == 0)
           {
            document.getElementById("total_dh").innerHTML=response.dh;
            document.getElementById("total_price").innerHTML=response.total_price;
            document.getElementById("total_pay").innerHTML=response.total_pay;
           }
           
       }
        });
       });

//show list sản phẩm, nhân viên
       function showViewNV()
       {
        var btnShow = document.getElementById("btnShow");
        var btnClose = document.getElementById("btnClose");
        var view_nv = document.getElementById("item__left");
        view_nv.style.height = 'auto';
        view_nv.style.overflowY = 'visible';
        btnShow.style.display = 'none';
        btnClose.style.display = 'block';
        
       }
       function closeViewNV()
       {
        var btnShow = document.getElementById("btnShow");
        var btnClose = document.getElementById("btnClose");
        var view_nv = document.getElementById("item__left");
        view_nv.style.height = '200px';
        view_nv.style.overflowY = 'hidden';
        btnShow.style.display = 'block';
        btnClose.style.display = 'none';
       }

       function showViewSP()
       {
        var btnShow = document.getElementById("btnShow2");
        var btnClose = document.getElementById("btnClose2");
        var view_sp = document.getElementById("item__right");
        view_sp.style.height = 'auto';
        view_sp.style.overflowY = 'visible';
        btnShow.style.display = 'none';
        btnClose.style.display = 'block';
       }
       function closeViewSP()
       {
        var btnShow = document.getElementById("btnShow2");
        var btnClose = document.getElementById("btnClose2");
        var view_sp = document.getElementById("item__right");
        view_sp.style.height = '200px';
        view_sp.style.overflowY = 'hidden';
        btnShow.style.display = 'block';
        btnClose.style.display = 'none';
       }
   


//thống kê biểu đồ cột
    function dash()
    {
      var tong = document.getElementById('soluong_sp').value;
       var quy_lap1 = document.getElementById('quy_lap1').value;
       var quy_pc1 = document.getElementById('quy_pc1').value;
       var quy_lap2 = document.getElementById('quy_lap2').value;
       var quy_pc2 = document.getElementById('quy_pc2').value;
       var quy_lap3 = document.getElementById('quy_lap3').value;
       var quy_pc3 = document.getElementById('quy_pc3').value;
       var quy_lap4 = document.getElementById('quy_lap4').value;
       var quy_pc4 = document.getElementById('quy_pc4').value;

       var div_quy_lap1 = document.getElementById('div_quy_lap1');
       var div_quy_pc1 = document.getElementById('div_quy_pc1');
       var div_quy_lap2 = document.getElementById('div_quy_lap2');
       var div_quy_pc2 = document.getElementById('div_quy_pc2');
       var div_quy_lap3 = document.getElementById('div_quy_lap3');
       var div_quy_pc3 = document.getElementById('div_quy_pc3');
       var div_quy_lap4 = document.getElementById('div_quy_lap4');
       var div_quy_pc4 = document.getElementById('div_quy_pc4');

       height_lap1 = (quy_lap1/tong)*100; 
       height_pc1 = (quy_pc1/tong)*100; 
       height_lap2 = (quy_lap2/tong)*100; 
       height_pc2 = (quy_pc2/tong)*100;
       height_lap3 = (quy_lap3/tong)*100; 
       height_pc3 = (quy_pc3/tong)*100;
       height_lap4 = (quy_lap4/tong)*100; 
       height_pc4 = (quy_pc4/tong)*100;   
      
       div_quy_lap1.style.height = height_lap1+'%';
       div_quy_pc1.style.height = height_pc1+'%';
       div_quy_lap2.style.height = height_lap2+'%';
       div_quy_pc2.style.height = height_pc2+'%';
       div_quy_lap3.style.height = height_lap3+'%';
       div_quy_pc3.style.height = height_pc3+'%';
       div_quy_lap4.style.height = height_lap4+'%';
       div_quy_pc4.style.height = height_pc4+'%';
   }
   dash();
   