@if(Session::has('nc_del')!=null)
<script>
	alert("Nhu cầu này đã có sản phẩm liên kết nên không thể xóa!");
	window.history.back();
</script>
{{Session::forget('nc_del')}}
@endif
<!--Loai-->
@if(Session::has('loai_del')!=null)
<script>
	alert("Loại này đã có sản phẩm liên kết nên không thể xóa!");
	window.history.back();
</script>
{{Session::forget('loai_del')}}
@endif
<!--Thương hiệu-->
@if(Session::has('th_del')!=null)
<script>
	alert("Thương hiệu này đã có sản phẩm liên kết nên không thể xóa!");
	window.history.back();
</script>
{{Session::forget('th_del')}}
@endif