	//Trường hợp trong tài khoản chưa có ảnh đại diện
	const btnFile = document.getElementById("khHinh");
	const imgDefault = document.getElementById("img__default");
	const cusBtn = document.getElementById("lb__khHinh");
	const imgChange = document.getElementById("img__change");
	//const fileName = document.getElementById("file__name");
	const btnCancel = document.getElementById("btnImg__cancel");
	
	function defaultAction()
	{
		btnFile.click();
	}
	btnFile.addEventListener("change", function(){
		const file = this.files[0];
		if(file)
		{
			const reader = new FileReader();
			reader.onload =  function(){
			const result = reader.result;
			imgChange.src = result;
			imgChange.style.display = 'block';
			imgDefault.style.opacity = '0%';
			//fileName.style.display = 'block';
			btnCancel.style.display = 'block';
		}
		btnCancel.addEventListener("click", function(){
			imgChange.src = "";
			imgChange.style.display = 'none';
			imgDefault.style.opacity = '100%';
			//fileName.style.display = 'none';
			btnCancel.style.display = 'none';
		});
		reader.readAsDataURL(file);
		}
		if(this.value)
		{
			let valueStore = this.value;
			fileName.textContent="Ảnh được thêm từ:"+ valueStore;
		}
	});