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
			  "plugins" : ["contextmenu", "search", "wholerow"],
				"contextmenu":{         
					"items": function(node) {
						var tree = $(container).jstree(true);
						return {
							"copy_sku": {
								"separator_before": false,
								"separator_after": false,
								"label": "Cop suggested SKU",																
								"action": function action(obj) {
									// console.log($(node).attr('id'));
									// console.log($('#' + $(node).attr('id') + '_anchor' + ' .suggested-sku').text());
								var text= $('#' + $(node).attr('id') + '_anchor' + ' .suggested-sku').text();
								window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
								
								}
							}
						};
					}
				}			  
			});	
			$("#s").submit(function(e) {
			  e.preventDefault();
			  $(container).jstree(true).search($("#q").val());
			});			
		  // $(container).on("changed.jstree", function (e, core) {
			// console.log("The selected nodes are:");
			// console.log(core.selected);
			  // console.log(core.instance.get_selected(true)[0].text);
			  // console.log(core.instance.get_node(core.selected[0]).text);			
		  // });			
		});	

})( jQuery );
