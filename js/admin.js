$(document).ready(function(){

	$('.dd').nestable({ maxDepth: 2 });
	
	$('.dd').on('change', function() {
		console.log( $('.dd').nestable('serialize') );
		if (window.JSON) {
            console.log(window.JSON.stringify($('.dd').nestable('serialize')));
			$('#proj_cats_json_hidden').val( window.JSON.stringify($('.dd').nestable('serialize')) )
        } else {
            console.log('JSON browser support required for this demo.');
        }
	});
	
	$('#proj_cats_list_save').on('click', function() {
		console.log( $('#proj_cats_json_hidden').val() );
		return true;
	});
	
});