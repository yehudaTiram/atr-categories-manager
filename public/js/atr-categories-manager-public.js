(function( $ ) {
	'use strict';
	// $( document ).ready(function() {
		// //https://github.com/vakata/jstree
		// $('.atr-cm-wrap').jstree();
	// });
	$( document ).ready(function() {
		$('.atr-cm-wrap').jstree({
		  "core" : {
			"check_callback" : function (operation, node, parent, position, more) {
			  if(operation === "copy_node" || operation === "move_node") {
				if(parent.id === "#") {
				  return false; // prevent moving a child above or below the root
				}
			  }
			  return true; // allow everything else
			}
		  },
		  "search": {
			 "case_insensitive": true,
			 "show_only_matches" : false
			},		  
		  "plugins" : ["dnd","contextmenu", "search"]

		});		
	});	


})( jQuery );
