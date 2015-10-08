var $j = jQuery.noConflict();
/* ---------------------------------------------------- */
/*	PARALLAX											*/
/* ---------------------------------------------------- */
jQuery.fn.parallax = function(xpos, speedFactor) {
'use strict';
var firstTop, methods = {};
return this.each(function(idx, value) {
var $this = jQuery(value), firstTop = $this.offset().top;
if (arguments.length < 1 || xpos === null)
xpos = "50%";
if (arguments.length < 2 || speedFactor === null)
speedFactor = 0.1;
methods = {
update: function() {
var pos = jQuery(window).scrollTop();
$this.each(function() {
$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
});
},
init: function() {
this.update();
jQuery(window).on('scroll', methods.update);
}
}
return methods.init();
});
};

//MOBILE MENU -----------------------------------------
//-----------------------------------------------------
jQuery(document).ready(function(){
	'use strict';
	jQuery('#menu-main').superfish();
	jQuery('#menu-main li.current-menu-item,#menu-main li.current_page_item,#menu-main li.current-menu-parent,#menu-main li.current-menu-ancestor,#menu-main li.current_page_ancestor').each(function(){
		jQuery(this).prepend('<span class="item_selected"></span>');
	});
});

(function( $ ) {
'use strict';
	$.fn.sktmobilemenu = function(options) { 
	var defaults = {
		'fwidth': 700
	};

		//call in the default otions
		var options = $.extend(defaults, options);
		var obj = $(this);
		return this.each(function() {
			if($(window).width() < options.fwidth) {
				sktMobileRes();
			}

			$(window).resize(function() {
				if($(window).width() < options.fwidth) {
					sktMobileRes();
				}else{
					sktDeskRes();
				}
			});
			function sktMobileRes() {
				jQuery('#menu-main').superfish('destroy');
				obj.addClass('instaapp-mob-menu').hide();
				obj.parent().css('position','relative');
					if(obj.prev('.sktmenu-toggle').length === 0) {
						obj.before('<div class="sktmenu-toggle" id="responsive-nav-button"></div>');
					}
				obj.parent().find('.sktmenu-toggle').removeClass('active');
			}

			function sktDeskRes() {
				jQuery('#menu-main').superfish('init');
				obj.removeClass('instaapp-mob-menu').show();
				if(obj.prev('.sktmenu-toggle').length) {
					obj.prev('.sktmenu-toggle').remove();
				}
			}

			obj.parent().on('click','.sktmenu-toggle',function() {
				if(!$(this).hasClass('active')){
					$(this).addClass('active');
					$(this).next('ul').stop(true,true).slideDown();
				}
				else{
					$(this).removeClass('active');
					$(this).next('ul').stop(true,true).slideUp();
				}
			});
		});
};
})( jQuery );

jQuery(document).ready(function ($) {
	'use strict';
	document.getElementById('s') && document.getElementById('s').focus();
});
jQuery(document).ready(function(){
	'use strict';
	jQuery( ".sf-with-ul" ).append( '<span class="fa fa-caret-down"></span>' );
});

jQuery(window).load(function(){ 
	if(jQuery('#skenav .instaapp-mob-menu').length > 0){		
		jQuery('#skenav .instaapp-mob-menu').css('width',jQuery('.row-fluid').width());
	}
});


jQuery(window).load(function(){
	'use strict';
	jQuery('#full-division-box').parallax("center", 0.2);
	jQuery('#full-subscription-box').parallax("center", 0.2);
});

jQuery(document).ready(function ($) {
'use strict';
jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
hook: 'data-rel',
animation_speed:'normal',
theme:'light_square',
slideshow:3000,
show_title:false,
autoplay_slideshow: false,
social_tools: false		
});
jQuery("a[rel^='prettyPhoto']").prettyPhoto({
animation_speed:'normal',
theme:'light_square',
slideshow:3000,
show_title:false,
autoplay_slideshow: false,
social_tools: false		
});
document.getElementById('s') && document.getElementById('s').focus();
});


//BACK TO TOP -----------------------------------------
//-----------------------------------------------------
jQuery(document).ready( function() {
'use strict';
jQuery('#back-to-top,#backtop').hide();
jQuery(window).scroll(function() {
if (jQuery(this).scrollTop() > 100) {
jQuery('#back-to-top,#backtop').fadeIn();
} else {
jQuery('#back-to-top,#backtop').fadeOut();
}
});
jQuery('#back-to-top,#backtop').click(function(){
jQuery('html, body').animate({scrollTop:0}, 'slow');
});
});
jQuery(window).load(function() {
'use strict';
var max = -1;
jQuery(".flexslider .slides li").each(function() {
var h = jQuery(this).height();
max = h > max ? h : max;
jQuery('.flexslider').css({'min-height': max});
});
});
jQuery(window).resize(function() {
'use strict';
var max = -1;
jQuery(".flexslider .slides li").each(function() {
var h = jQuery(this).height();
max = h > max ? h : max;
jQuery('.flexslider').css({'min-height': max});
});
});

//WAYPOINTS MAGIC -----------------------------------------
//---------------------------------------------------------
if ( typeof window['vc_waypoints'] !== 'function' ) {
	function vc_waypoints() {
	if (typeof jQuery.fn.waypoint !== 'undefined') {
		$j('.fade_in_hide').waypoint(function() {
				$j(this).addClass('instaapp_start_animation');
			}, { offset: '90%' });
			$j('.instaapp_animate_when_almost_visible').waypoint(function() {
				$j(this).addClass('instaapp_start_animation');
			}, { offset: '90%' });
		}
	}
}
jQuery(document).ready(function($) {
'use strict';
vc_waypoints();

jQuery('.instaapp-counter').waypoint(function() {

	var counter = jQuery(this).find('.instaapp-counter-number'),
		count = parseInt(counter.text(), 10),
		prefix = '',
		suffix = '',
		number = 0;

	if (jQuery(this).data('count')) {
		count = parseInt(jQuery(this).data('count'), 10);
	}
	if (jQuery(this).data('prefix')) {
		prefix = jQuery(this).data('prefix');
	}
	if (jQuery(this).data('suffix')) {
		suffix = jQuery(this).data('suffix');
	}

	var	step = Math.ceil(count/25),
	handler = setInterval(function() {
	number += step;
	counter.text(prefix+number+suffix);
		if (number >= count) {
			counter.text(prefix+count+suffix);
			window.clearInterval(handler);
		}
	}, 40);


 }, {offset:'85%', triggerOnce: true});
 }); 
//------------------------------------------------------------
 
jQuery(document).ready(function($) {
	'use strict';
	//SEARCH BOX
	jQuery('.search-strip, .hsearch .hsearch-close').on('click', function(){
		jQuery('.hsearch .row-fluid').slideDown( "fast", "linear" );
	});
	jQuery('.hsearch .hsearch-close').on('click', function(){
		jQuery('.hsearch .row-fluid').slideUp( "fast", "linear" );
	});

	//Contact Map Overly
	jQuery('#contact-gmap-toggle').click(function(){
		jQuery('.contact-map-overlay').fadeToggle( "slow", "linear" );
	});
});

// jQuery for header flags

jQuery(document).ready(function($) {
    'use strict';
    jQuery('#header-top .dropdown-toggle').on('click', function(){
        jQuery('#header-top .dropdown-menu.langs').fadeToggle( "fast", "linear" );
    });
});





// Logo First Word Bold js
jQuery(document).ready(function($) {
	jQuery(function() {
	    jQuery('#logo #site-title a').each(function() {
	        var text = this.innerHTML;
	        var firstSpaceIndex = text.indexOf(" ");
	        if (firstSpaceIndex > 0) {
	            var substrBefore = text.substring(0,firstSpaceIndex);
	            var substrAfter = text.substring(firstSpaceIndex, text.length)
	            var newText = '<span class="firstlogoWord">' + substrBefore + '</span>' + substrAfter;
	            this.innerHTML = newText;
	        } else {
	            this.innerHTML = '<span class="firstlogoWord">' + text + '</span>';
	        }
	    });
	});
});