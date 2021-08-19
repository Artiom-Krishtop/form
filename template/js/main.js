$(document).ready(function(){
		$("#btn").click(function () {
var msg   = $('#form').serialize();
	$.ajax({
		type: 'POST',
		dataType : "json",
		url: '/login',
		data: msg,
		success: function(data) {
			data = JSON.parse(data)
			$('#errors').html(data);
		}
	});

		});
});
