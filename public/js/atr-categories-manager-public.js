// (function( $ ) {
	// 'use strict';
	// //https://github.com/vakata/jstree
	// function suggested_sku_menu(node) {
	  // return {
				// "copy_sku": {
					// "separator_before": false,
					// "separator_after": false,
					// "label": "Copy suggested SKU",																
					// "action": function action(obj) {
					// var text= $('#' + node.id + '_anchor' + ' .suggested-sku').text();
					// window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
					
					// }
				// },
				// "go_to_category": {
					// "separator_before": false,
					// "separator_after": false,
					// "label": "Go to this category",																
					// "action": function action(obj) {
								// console.log( $('#' + node.id).data( "link" ) );
								// var href = $('#' + node.id).data( "link" ) ;
								// document.location.href = href;

					// // var text= $('#' + node.id + '_anchor' + ' .suggested-sku').text();
					// // window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
					
					// }
				// }				
			// }; 
	// }	
	// $( document ).ready(		
		// function() {
			// var container = $('.atr-cm-wrap');
			// $(container).jstree({
			  // "core" : {
				// "check_callback" : false,
				// "themes" : {				  
						// 'dir':false,
						// 'dots':true,
						// 'ellipsis':true,
						// 'icons':true,
						// 'name':false,
						// 'responsive':true,
						// 'stripes':false,
						// 'url':false,
						// 'variant':'medium',
				// }				
			  // },
			  // "search": {
				 // "case_insensitive": true,
				 // "show_only_matches" : false
				// },		  
			  // "plugins" : ["contextmenu", "search", "wholerow"],
			  
				// "contextmenu":{ 
				// 'items': suggested_sku_menu
				// }			  
			// });	
			// $("#s").submit(function(e) {
			  // e.preventDefault();
			  // $(container).jstree(true).search($("#q").val());
			// });			
		  // // $(container).on("changed.jstree", function (e, core) {
			// // console.log($.jstree.defaults);  
			// // console.log("The selected nodes are:");
			// // console.log(core.selected);
			  // // console.log(core.instance.get_selected(true)[0].text);
			  // // console.log(core.instance.get_node(core.selected[0]).text);			
		  // // });			
		// });	

// })( jQuery );
