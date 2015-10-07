/*
 * Custom v1.0
 * DesignOrbital.com
 *
 * Copyright (c) 2013 DesignOrbital.com
 *
 * License: GNU General Public License, GPLv3
 * http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

(function($){
			
	var future = {
		
		themeClassesInit: function() {

			/**
			* Semantic Classes
			*/

			/** Add class "widget-last" to dynamic widgets in the sidebars. */
			$( '.sidebar .widget:last-child, .footer-tail-sidebars .widget:last-child' ).addClass( 'widget-last' );

			/**
			* For Bootstrap Styling
			*/

			/** Add "table" class to tables. */
			$( 'table' ).addClass( 'table' );

			/** Add "form-control" class to dynamic widgets in the sidebars. */
			$( '.widget select' ).addClass( 'form-control' );

			/** Add "btn" classes to comment links. */
			$( '.comment-edit-link, .comment-reply-link, .comment-reply-login, #cancel-comment-reply-link' ).addClass( 'btn btn-primary btn-xs' );

			/** Add "btn" classes to comment form / contact form 7 submit. */
			$( '#respond #submit' ).addClass( 'btn btn-primary' );

			/** Add "panel-warning" class to author comments. */	
			$( '.comment.bypostauthor > .comment-wrapper .panel' ).removeClass( 'panel-default' ).addClass( 'panel-warning' );

			/** Add "img-thumbnail" class to attachment pager images. */
			$( '.pagination-wrapper-attachment img' ).addClass( 'img-thumbnail' );

		}
		
	}
	
	/** Document Ready */
	$(document).ready(function(){		
		
		/** Theme Classes */
		future.themeClassesInit();

		/** FitVids */
		$( '.entry-media-video-wrapper, .entry-content-video' ).fitVids();
		$( '.entry-content-video > div' ).css({ 'width':'100%' });
		
		/** Tool Tip */
		$( 'a[data-toggle="tooltip"]' ).tooltip();

	});

})(jQuery);