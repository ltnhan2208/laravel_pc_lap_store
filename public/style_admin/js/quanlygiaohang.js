
    var searchNV = document.getElementById("adMa");
    if(searchNV != null)
    {
            searchNV.onchange = function(){ 
            var link = searchNV.value;
            window.location=link;
        }
    }
	
     var danggiao = document.getElementById("don__danggiao");
    var dagiao = document.getElementById("don__dagiao");
     var hdTinhtrang = document.getElementById("hdTinhtrang");
     hdTinhtrang.onchange = function(){ 
        if(hdTinhtrang.value == 1)
        {
            danggiao.style.display = 'block';
            dagiao.style.display = 'none';
        }
        if(hdTinhtrang.value == 2)
        {
            danggiao.style.display = 'none';
            dagiao.style.display = 'block';
        }
    }
