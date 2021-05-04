@if (Session::has('message'))
	<script type="text/javascript">
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "3000",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		toastr.{{Session::get('status')}}('{!! Session::get('message') !!}');
	</script>
@endif 
