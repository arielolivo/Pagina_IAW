$(document).ready(function() {

	$(".like").click(function() {

		var id = this.id; // obtenemos la id

		// AJAX

		$.ajax({
			url: 'likes.php',
			type: 'post',
			data: {id:id},
			dataType: 'json',
			success: function(data) {
				var img = data['img'];

					$('#'+id).html(img);
			}
		});

	});

});