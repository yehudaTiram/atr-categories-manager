(function( $ ) {
	'use strict';
	//https://github.com/vakata/jstree
	$( document ).ready(
		
		function() {
			var container = $('.atr-cm-wrap');
			$(container).jstree({
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
			  "plugins" : ["contextmenu", "search"]
			});	
			$("#s").submit(function(e) {
			  e.preventDefault();
			  $(container).jstree(true).search($("#q").val());
			});			
		  $(container).on("changed.jstree", function (e, core) {
			console.log("The selected nodes are:");
			console.log(core.selected);
			  console.log(core.instance.get_selected(true)[0].text);
			  console.log(core.instance.get_node(core.selected[0]).text);			
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
