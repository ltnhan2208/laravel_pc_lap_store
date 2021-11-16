//Preview Image Input file
const img = document.getElementById("imgtt");
const inputImg = document.getElementById("inputImg");
const btnCancel = document.getElementById("btnCanceltt");
const text = document.getElementsByClassName("text")[0];
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
			img.src = result;
			img.style.display = 'block';
			btnCancel.style.display = 'block';
			text.style.display = 'none';
		}
		btnCancel.addEventListener("click",function(){
			img.src = "";
			img.style.display = 'none';
			btnCancel.style.display = 'none';
			text.style.display = 'block';
		});
		reader.readAsDataURL(file);
	}
}); 


