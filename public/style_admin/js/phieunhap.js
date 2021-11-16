	var btnPN = document.getElementById("btn__phieunhap");
	var arr_serial = ['111'];
	function addRow()
	{
		var serial = document.getElementById("serial").value;

	
		serial=serial.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
		serial=serial.replace(/[^a-zA-Z0-9 ]/g, "");

		var spMa = document.getElementById("spMa").value;
		var nccMa = document.getElementById("nccMa").value;
		//var soluong = document.getElementById("soluong").value;
		var giaSp = document.getElementById("gia").value;
		var giaThue = document.getElementById("giaThue").value;
		var gia = Number(giaSp)+Number(giaSp*(giaThue*0.01));

		var err_ser = document.getElementById("err__ser");
		err_ser.style.color = 'red';
		var err_gia = document.getElementById("err__gia");
		err_gia.style.color = 'red';
		var err_thue = document.getElementById("err__thue");
		err_thue.style.color = 'red';

		var rowSL = document.getElementById("row__soluong");
		var rowGia = document.getElementById("row__tongtien");

		var table = document.getElementById("tbody__phieunhap");

		selectSP = document.getElementById("spMa");
		optionsSP = selectSP.getElementsByClassName('opSP');
		optionSP = optionsSP[selectSP.selectedIndex].innerHTML;
		selectNCC = document.getElementById("nccMa");
		optionsNCC = selectNCC.getElementsByClassName('opNCC');
		optionNCC = optionsNCC[selectNCC.selectedIndex].innerHTML;	
		if(arr_serial.includes(serial)==true)
		{
			err_ser.innerHTML = "Serial không được trùng";
			return false;
			// console.log('trùng');
			// console.log(arr_serial);
		}
		else if(arr_serial.includes(serial)==false)
		{
					var addRow = `
					<tr style="border: 0;">
				 	<td>

				 		<input class="input__phieunhap" name="spMa[]" type="text" hidden readonly value=${spMa}>
				 		${optionSP}
				 	</td>
				 	<td>
				 		<input class="input__phieunhap" name="nccMa[]" hidden type="text" readonly value=${nccMa}>
				 		${optionNCC}
				 	</td>
				 	<td>
				 		<input class="input__phieunhap" name="serMa[]" type="text" readonly value="${serial}">
				 		<input class="gia input__phieunhap" hidden name="gia[]" type="text" readonly value=${gia}>
				 	</td>
				 	<td>
				 		${gia}
				 	</td>
				 	<td>
				 		<span class="btn btn-danger">Xóa</span>
				 	</td>
				 	</tr>`;
		// if(soluong=="")<input hidden class="input__phieunhap" name="tonggiasp[]" type="text" readonly value=${gia}
		// {
		// 	err_sl.innerHTML = "Số lượng không được rỗng";
		// 	return false;
		// }
		// if(soluong<0)
		// {
		// 	err_sl.innerHTML = "Số lượng không được ít hơn 0";
		// 	return false;
		// }
		if(giaSp=="")
		{
			err_gia.innerHTML = "Giá không được rỗng";
			return false;
		}
		if(serial=="")
		{
			err_ser.innerHTML = "Serial không được rỗng";
			return false;
		}
		if(serial.length<11 || serial.length>20)
		{
			err_ser.innerHTML = "Độ dài serial phải từ 11->20 ký tự";
			return false;
		}
		if(giaSp<0)
		{
			err_gia.innerHTML = "Giá không được ít hơn 0";
			return false;
		}
		if(giaThue<0)
		{
			err_thue.innerHTML = "Thuế không được ít hơn 0";
			return false;
		}
		else{
			for(var n = 0;n<1;n++)
			{
				 table.innerHTML+= addRow;
			}
				 var ip__sl = document.querySelectorAll(".sl");
				 var ip__gia = document.querySelectorAll(".gia");
				 var sumSL = 0;
				 var sumGia = 0;
				 // for(var i = 0;i< ip__sl.length;i++)
				 // {
				 // 	sumSL = sumSL + parseInt(ip__sl[i].value);
				 // }
				 for(var y =0;y<ip__gia.length;y++)
				 {
				 	sumGia = sumGia + parseInt(ip__gia[y].value);
				 	sumSL++;
				 }

				 rowSL.style.display = 'block';
				 rowSL.value = sumSL;
				 rowGia.style.display = 'block';
				 rowGia.value = sumGia;

				 err_ser.innerHTML = "";
				 err_gia.innerHTML = "";
				 err_thue.innerHTML = "";
		}
			// console.log('không trùng');
			arr_serial.push(serial);
			// console.log(arr_serial);
		}
		
		var index, table = document.getElementById("table__result");
		var gia = document.getElementsByClassName("gia").value;
		var rowSL2 = document.getElementById("row__soluong");
		var rowGia2 = document.getElementById("row__tongtien");
		for(var i =0; i<table.rows.length;i++)
		{	
				table.rows[i].cells[4].onclick = function()
				{
				index = this.parentElement.rowIndex;
				g = Number(table.rows[index].cells[3].innerHTML);
				table.deleteRow(index);
				rowGia2.value = rowGia2.value - g;
				rowSL2.value = rowSL2.value - 1;
				}
		}

	}


