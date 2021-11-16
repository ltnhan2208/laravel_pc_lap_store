/////////////KIỂU TỰ ĐỘNG//////////////////
var bigImg = document.getElementById("img__default");
var boxParent = document.querySelectorAll(".img__item");
for(var i = 0;i<boxParent.length;i++)
{
	boxParent[i].addEventListener('click', show);
}

function show()
{
	console.log();
	bigImg.innerHTML=this.innerHTML;
}



/////////KIỂU CỐ ĐỊNH/////////////
// ////////IMAGES PRODUCT/////////////
// 	let pos = document.getElementById("pos__1");
// 	let imgCss = document.getElementById("img__1");
// 	pos.style.backgroundColor = '#F54646';
// 	imgCss.style.border = '3px solid #F54646';
// 	function changeImg1()
// 	{
// 		var img_default = document.getElementById("img__default");
// 		var img = document.getElementById("img__1").innerHTML;
// 		var pos = document.getElementById("pos__1");
// 		var pos2 = document.getElementById("pos__2");
// 		var pos3 = document.getElementById("pos__3");
// 		var pos4 = document.getElementById("pos__4");
// 		var imgCss = document.getElementById("img__1");
// 		var imgCss2 = document.getElementById("img__2");
// 		var imgCss3 = document.getElementById("img__3");
// 		var imgCss4 = document.getElementById("img__4");
// 		pos.style.backgroundColor = '#F54646';
// 		pos2.style.backgroundColor = 'transparent';
// 		pos3.style.backgroundColor = 'transparent';
// 		pos4.style.backgroundColor = 'transparent';
// 		imgCss4.style.border = '0';
// 		imgCss3.style.border = '0';
// 		imgCss2.style.border = '0';
// 		imgCss.style.border = '3px solid #F54646';
// 		img_default.innerHTML = img;
// 	}
// 	function changeImg2()
// 	{
// 		var img_default = document.getElementById("img__default");
// 		var img = document.getElementById("img__2").innerHTML;
// 		var pos = document.getElementById("pos__2");
// 		var pos2 = document.getElementById("pos__1");
// 		var pos3 = document.getElementById("pos__3");
// 		var pos4 = document.getElementById("pos__4");
// 		var imgCss = document.getElementById("img__2");
// 		var imgCss2 = document.getElementById("img__1");
// 		var imgCss3 = document.getElementById("img__3");
// 		var imgCss4 = document.getElementById("img__4");
// 		pos.style.backgroundColor = '#F54646';
// 		pos2.style.backgroundColor = 'transparent';
// 		pos3.style.backgroundColor = 'transparent';
// 		pos4.style.backgroundColor = 'transparent';
// 		imgCss4.style.border = '0';
// 		imgCss3.style.border = '0';
// 		imgCss2.style.border = '0';
// 		imgCss.style.border = '3px solid #F54646';
// 		img_default.innerHTML = img;
// 	}
// 	function changeImg3()
// 	{
// 		var img_default = document.getElementById("img__default");
// 		var img = document.getElementById("img__3").innerHTML;
// 		var pos = document.getElementById("pos__3");
// 		var pos2 = document.getElementById("pos__2");
// 		var pos3 = document.getElementById("pos__1");
// 		var pos4 = document.getElementById("pos__4");
// 		var imgCss = document.getElementById("img__3");
// 		var imgCss2 = document.getElementById("img__2");
// 		var imgCss3 = document.getElementById("img__1");
// 		var imgCss4 = document.getElementById("img__4");
// 		pos.style.backgroundColor = '#F54646';
// 		pos2.style.backgroundColor = 'transparent';
// 		pos3.style.backgroundColor = 'transparent';
// 		pos4.style.backgroundColor = 'transparent';
// 		imgCss4.style.border = '0';
// 		imgCss3.style.border = '0';
// 		imgCss2.style.border = '0';
// 		imgCss.style.border = '3px solid #F54646';
// 		img_default.innerHTML = img;
// 	}
// 	function changeImg4()
// 	{
// 		var img_default = document.getElementById("img__default");
// 		var img = document.getElementById("img__4").innerHTML;
// 		var pos = document.getElementById("pos__4");
// 		var pos2 = document.getElementById("pos__2");
// 		var pos3 = document.getElementById("pos__3");
// 		var pos4 = document.getElementById("pos__1");
// 		var imgCss = document.getElementById("img__4");
// 		var imgCss2 = document.getElementById("img__2");
// 		var imgCss3 = document.getElementById("img__3");
// 		var imgCss4 = document.getElementById("img__1");
// 		pos.style.backgroundColor = '#F54646';
// 		pos2.style.backgroundColor = 'transparent';
// 		pos3.style.backgroundColor = 'transparent';
// 		pos4.style.backgroundColor = 'transparent';
// 		imgCss4.style.border = '0';
// 		imgCss3.style.border = '0';
// 		imgCss2.style.border = '0';
// 		imgCss.style.border = '3px solid #F54646';
// 		img_default.innerHTML = img;
// 	}




////////SHOW HIDE MOTA danhgia/////////////
function showMota()
{
	var title_mt = document.getElementById("show__mota");
	var title_bl =document.getElementById("show__danhgia");
	var box_mt = document.getElementById("content__mota");
	var box_bl = document.getElementById("content__danhgia");
	title_mt.style.border = '1px solid #ddd';
	title_mt.style.borderBottom = '1px solid white';
	title_mt.style.color = 'darkblue';
	title_bl.style.border = '0';
	title_bl.style.borderBottom = '1px solid #ddd';
	title_bl.style.color = 'blue';
	box_mt.style.display = 'block';
	box_bl.style.display = 'none';
}

function showDanhgia()
{
	var title_bl =document.getElementById("show__danhgia");
	var title_mt = document.getElementById("show__mota");
	var box_bl = document.getElementById("content__danhgia");
	var box_mt = document.getElementById("content__mota");
	title_bl.style.border = '1px solid #ddd';
	title_bl.style.borderBottom = '1px solid white';
	title_bl.style.color = 'darkblue';
	title_mt.style.border = '0';
	title_mt.style.borderBottom = '1px solid #ddd';
	title_mt.style.color = 'blue';
	box_mt.style.display = 'none';
	box_bl.style.display = 'block';
}


