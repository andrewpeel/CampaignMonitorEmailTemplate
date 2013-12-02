/**
 * Created by andrewpeel on 28/11/13.
 */
jQuery.fn.sameHeightAs = function(targetWithHeight){

    var maxheight = 0;

    if(targetWithHeight == undefined){
        targetWithHeight = jQuery(this);
    }

    targetWithHeight.each(function () {
        maxheight = (jQuery(this).height() > maxheight ? jQuery(this).height() : maxheight);
    });

    jQuery(this).css('height', maxheight);

};
//$('.gray').sameHeightAs($('.gray'));
//$('.gray').sameHeightAs();