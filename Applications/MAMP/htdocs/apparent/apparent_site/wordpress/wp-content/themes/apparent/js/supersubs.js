/*
 * Supersubs v0.2b - jQuery plugin
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 *
 * This plugin automatically adjusts submenu widths of suckerfish-style menus to that of
 * their longest list item children. If you use this, please expect bugs and report them
 * to the jQuery Google Group with the word 'Superfish' in the subject line.
 *
 */

(function($){$.fn.supersubs=function(options){var opts=$.extend({},$.fn.supersubs.defaults,options);return this.each(function(){var $$=$(this);var o=$.meta?$.extend({},opts,$$.data()):opts;var fontsize=$('<li id="menu-fontsize">&#8212;</li>').css({padding:0,position:"absolute",top:"-999em",width:"auto"}).appendTo($$).width();$("#menu-fontsize").remove();$ULs=$$.find("ul");$ULs.each(function(i){var $ul=$ULs.eq(i);var $LIs=$ul.children();var $As=$LIs.children("a");var liFloat=$LIs.css("white-space","nowrap").css("float");var emWidth=$ul.add($LIs).add($As).css({"float":"none",width:"auto"}).end().end()[0].clientWidth/fontsize;emWidth+=o.extraWidth;if(emWidth>o.maxWidth){emWidth=o.maxWidth;}else{if(emWidth<o.minWidth){emWidth=o.minWidth;}}emWidth+="em";$ul.css("width",emWidth);$LIs.css({"float":liFloat,width:"100%","white-space":"normal"}).each(function(){var $childUl=$(">ul",this);var offsetDirection=$childUl.css("left")!==undefined?"left":"right";$childUl.css(offsetDirection,emWidth);});});});};$.fn.supersubs.defaults={minWidth:9,maxWidth:25,extraWidth:0};})(jQuery);