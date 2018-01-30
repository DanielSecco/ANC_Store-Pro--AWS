(function($) {
    'use strict';

    $(document).ready(function(){
        mkdInitMessages();
        mkdInitMessageHeight();
    });

/*
 **	Function to close message shortcode
 */
function mkdInitMessages(){
    var message = $('.mkd-message');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            thisMessage.find('.mkd-close').click(function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(500);
            });
        });
    }
}

/*
 **	Init message height
 */
function mkdInitMessageHeight(){
    var message = $('.mkd-message.mkd-with-icon');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            var textHolderHeight = thisMessage.find('.mkd-message-text-holder').height();
            var iconHolderHeight = thisMessage.find('.mkd-message-icon-holder').height();

            if(textHolderHeight > iconHolderHeight) {
                thisMessage.find('.mkd-message-icon-holder').height(textHolderHeight);
            } else {
                thisMessage.find('.mkd-message-text-holder').height(iconHolderHeight);
            }
        });
    }
}

})(jQuery);