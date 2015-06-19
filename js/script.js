( function( $ ) {
$( document ).ready(function() {
$('.cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('.cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
});
} )( jQuery );

if($( window ).width() > 1100){
   //$( 'div#bannervideoAd' ).show();
  }else {
    $( 'div#bannervideo' ).hide();
  }
jQuery(document).ready(function() {
 $('div#bannervideo a.close').click(function(e){
 e.preventDefault();
 $('div#bannervideo').hide();
  });
});
