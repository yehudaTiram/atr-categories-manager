(function( $ ) {
	'use strict';
	//https://github.com/vakata/jstree
	$( document ).ready(
		function() {
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
		  $('.atr-cm-wrap').on("changed.jstree", function (e, core) {
			console.log("The selected nodes are:");
			console.log(core.selected);
		  });			
		});	

// $(function() {
  // $('.atr-cm-wrap').jstree({
    // 'core' : {
      // 'data' : [
        // {"id" : 1, "text" : "Node 1"},
        // {"id" : 2, "text" : "Node 2"},
      // ]
    // }
  // });
  // $('.atr-cm-wrap').on("changed.jstree", function (e, data) {
    // console.log("The selected nodes are:");
    // console.log(data.selected);
  // });
// });	


})( jQuery );
