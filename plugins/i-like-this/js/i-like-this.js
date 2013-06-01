function likeThis( postId ) {
	if ( postId != '' ) {
		
		jQuery('#iLikeThis-' + postId + ' .counter').addClass('loading');
		
		jQuery.post(blogUrl + "/wp-content/plugins/i-like-this/like.php", { 
			id: postId 
		},
		function(data){
			jQuery('#iLikeThis-' + postId + ' .counter').removeClass('counter');
			jQuery('#iLikeThis-' + postId + ' .loading').addClass('inactive');
			jQuery('#iLikeThis-' + postId + ' .inactive').removeClass('loading');
			jQuery('#iLikeThis-' + postId + ' .inactive' ).text(data);
			
		});
	}
}