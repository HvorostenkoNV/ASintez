$(function() {
    $(".alfasintez-catalog-sections-menu .open-button").on('vclick', function(){
        var
            $block  = $(this).closest('.sections-block'),
            $body   = $block.find('.body');

        if( $body.is(':visible') )
        {
            $block.addClass('closed');
            $body.show().slideUp();
        }
        else
        {
            $block.removeClass('closed');
            $body.hide().slideDown();
        }
    });
});