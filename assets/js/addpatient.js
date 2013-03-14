$(document).ready(function() {
	$('#p_save').click(function(e) {
		$('#patient-create').submit();
		e.preventDefault();
	});
});
