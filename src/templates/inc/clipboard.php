<?php

function anred_clean_on_paste( $in ) {
	$in['paste_preprocess'] = "function( plugin, args ) {

		var whitelist = 'a,p,span,b,strong,i,em,h3,h4,h5,h6,ul,li,ol';
		var stripped = jQuery('<div>' + args.content + '</div>');
		var els = stripped.find('*').not(whitelist);

		for (var i = els.length - 1; i >= 0; i--) {
			var e = els[i];
			jQuery(e).replaceWith(e.innerHTML);
		}
		
		stripped.find('*').removeAttr('id').removeAttr('class').removeAttr('align');
		
		args.content = stripped.html();
	}";
	return $in;
}

add_filter('tiny_mce_before_init','anred_clean_on_paste');