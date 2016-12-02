$(window).load(function(){

    // --------------------------------------- //
    // DIALOG //
    // --------------------------------------- //

    $('.dialog-trigger').click(function(){
        $( $(this).attr('href')).fadeIn();
        return false;
    });

    $('.dialog-close').click(function(){
        $('.dialog-overlay').fadeOut();
        return false;
    });

    $('.dialog-overlay').click(function(e){
        if ( $(e.target).hasClass('dialog-overlay') ) $('.dialog-overlay').fadeOut();
    });

    // --------------------------------------- //
    // PROJECT OPTIONS //
    // --------------------------------------- //
    $('.project-options-selector').click(function(){
        if ( $(this).hasClass('active') ) return false;
        $('.project-options-content').slideUp(600);
        $('.project-options-selector').removeClass('active', 300);
        $( $(this).attr('href')).slideDown(600);
        $(this).addClass('active', 300);
        return false;
    }); 
});