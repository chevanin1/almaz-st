var HeaderType = 'big';

$(document).ready(function(){
	
	
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		console.log("scroll pos "+scroll+" header type "+HeaderType);
		
		// Change header
		if( ( scroll > 50 ) && ( HeaderType != 'small' ) ) {
			HeaderType = 'small';
			$('header > nav > .container-fluid > .navbar-header > a > img').css("display", "none");
			$('header > nav > .container-fluid > .navbar-header > a > img').attr('src', "/img/logo-small.png");
			$('header > nav > .container-fluid > .navbar-header > a > img').fadeIn(1000);	
			$('header > nav > .container-fluid > .navbar-header').animate({'width': '50px'},1000);
			$('header > nav > .container-fluid > .navbar-header > .header-top-info').fadeOut(1000);
			$('li.menu-phone-point').fadeIn(1000);		
			$('header > nav').animate({'height': '60px'}, 1000);
			$('header > nav > .container-fluid > .top_menu').animate({'height':'60px', 'margin-top': '0px'}, 1000);
			$('body').animate({'padding-top': '70px'},1000);			
		} else {
			if( ( scroll <= 50 ) && ( HeaderType != 'big' ) ) {
			HeaderType = 'big';
			$('header > nav > .container-fluid > .navbar-header > a > img').css("display", "none");
			$('header > nav > .container-fluid > .navbar-header > a > img').attr('src', "/img/logo-big.png");
			$('header > nav > .container-fluid > .navbar-header > a > img').fadeIn(1000);
			$('header > nav > .container-fluid > .navbar-header').animate({'width': '100%'},1000);
			$('header > nav > .container-fluid > .navbar-header > .header-top-info').fadeIn(1000);		
			$('li.menu-phone-point').fadeOut(1000);		
			$('header > nav').animate({'height': '100px'}, 1000);
			$('header > nav > .container-fluid > .top_menu').animate({'height':'auto', 'margin-top': '50px'}, 1000);
			$('body').animate({'padding-top': '120px'},1000);
			
			} // End if
		} // End if
		
	});
	
	
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});
	

});



