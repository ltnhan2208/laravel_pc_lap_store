	var left__arr = document.getElementById("left__arr");
   	var right__arr =  document.getElementById("right__arr");
   	var pro = document.getElementsByClassName("product");
   	var l = 0;
   	right__arr.onclick = ()=>{
   		l++;
   		for(var i of pro)
   		{
   			if(l==0){ i.style.left = '0px'; }
   			if(l==1){ i.style.left = '-100%'; }
   			if(l==2){ i.style.left = '0px'; }
   			if(l>2){l=0;}
   		}
   						
   		}
   		left__arr.onclick = ()=>{
	   	l--;
	   	for(var i of pro)
	   	{
	   		if(l==0){ i.style.left = '0px'; }
	   		if(l==1){ i.style.left = '-100%'; }
	   		if(l==2){ i.style.left = '0px'; }
	   		if(l<0){l=0;}
	   	}					
   	}

    var left__arr2 = document.getElementById("left__arr2");
    var right__arr2 =  document.getElementById("right__arr2");
    var pro2 = document.getElementsByClassName("product2");
    var l2 = 0;
    right__arr2.onclick = ()=>{
        l2++;
        for(var i of pro2)
        {
            if(l2==0){ i.style.left = '0px'; }
            if(l2==1){ i.style.left = '-100%'; }
            if(l2==2){ i.style.left = '0px'; }
            if(l2>2){l2=0;}
        }
                        
        }

        left__arr2.onclick = ()=>{
        l2--;
        for(var i of pro2)
        {
            if(l2==0){ i.style.left = '0px'; }
            if(l2==1){ i.style.left = '-100%'; }
            if(l2==2){ i.style.left = '0px'; }
            if(l2<0){l2=0;}
        }
                        
    }


  // SCROLL TOP
    
     var nut = document.getElementById("scroll");
        //Truy xuất icon
        nut.onclick = function(){
            var chieucaoht = self.pageYOffset;
            // lấy chiều cao hiện tại của trang
            var set = chieucaoht;
            var run = setInterval(function(){
                chieucaoht = chieucaoht - 0.05*set;
                window.scrollTo(0,chieucaoht);    
                if(chieucaoht <= 0){
                    clearInterval(run);
                }        
            },15)
        }