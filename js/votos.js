jQuery(document).ready(function($){

	$(document.body).on('click', '.b' ,function(e){
		e.preventDefault();
		var type = $(this).data("type");
		var id = $(this).data("id");
		$('#cn_theme_rating').html('<span id="loading" class="fa-spinner">'+CRating.loading+'</span>');
		$.post(CRating.ajaxurl, { 'action': 'cn_rating_action', 'id': id, 'type': type, 'nonce': CRating.cnthemeratingnonce }, function(html){
			$('#cn_theme_rating').html(html);			
		});
	});

});