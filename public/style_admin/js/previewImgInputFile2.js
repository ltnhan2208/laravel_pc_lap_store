//Preview Image Input file
let imgDefault = document.getElementById("imgDefault");
let img = document.getElementById("img");
let inputImg = document.getElementById("inputImg");
let btnCancel = document.getElementById("btnCancel");
function defaultAction()
	{
		inputImg.click();
	}

inputImg.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		const reader = new FileReader();
		reader.onload = function(){
			const result = reader.result;
			
			imgDefault.style.display = 'none';
			img.src = result;
			img.style.display = 'block';
			btnCancel.style.display = 'block';
		}
		btnCancel.addEventListener("click",function(){
			imgDefault.style.display = 'block';
			img.src = "";
			img.style.display = 'none';
			btnCancel.style.display = 'none';
		});
		reader.readAsDataURL(file);
	}
}); 


