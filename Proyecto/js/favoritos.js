$(document).ready(function() {

	$(".fav").click(function() {

		var id = this.id; // obtenemos la id

		// AJAX

		$.ajax({
			url: 'favoritos.php',
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