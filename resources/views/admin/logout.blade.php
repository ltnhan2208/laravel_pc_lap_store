@if(Session::has('adTaikhoan')!=null)
	session()->forget('adTaikhoan')
@endif
	


	<script>
		window.location="{{URL::to('/adLogin')}}";
	</script>
