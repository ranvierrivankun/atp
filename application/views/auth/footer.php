<!-- Required Js -->
<script src="<?= base_url('/') ?>assets/plugins/js/vendor-all.min.js"></script>
<script src="<?= base_url('/') ?>assets/plugins/js/plugins/bootstrap.min.js"></script>

</body>
</html>

<!-- REMOVE ALERT -->
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 2000);
</script>