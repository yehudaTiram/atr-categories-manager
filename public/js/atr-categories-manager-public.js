/** @format */

(function($) {
  "use strict";
  //https://github.com/vakata/jstree
  $(document).ready(function() {
    var container = $(".atr-cm-wrap");
    $(container).jstree({
      core: {
        check_callback: function(operation, node, parent, position, more) {
          if (operation === "copy_node" || operation === "move_node") {
            if (parent.id === "#") {
              return false; // prevent moving a child above or below the root
            }
          }
          return true; // allow everything else
        },
      },
      search: {
        case_insensitive: true,
        show_only_matches: false,
      },
      plugins: ["contextmenu", "search", "wholerow"],
      contextmenu: {
		  items: function (node) {
          var tree = $(container).jstree(true);
          return {
            view_cat: {
              separator_before: false,
              separator_after: false,
              label: "View this category",
              action: function action(obj) {
                let url = node.a_attr.href;
                window.open(url);
              },
              icon: "dashicons dashicons-visibility",
            },
            edit_cat: {
              separator_before: true,
              separator_after: false,
              label: "Edit this category",
              action: function action(obj) {
                var text = $(
                  "#" + $(node).attr("id") + "_anchor" + " .suggested-sku"
                ).text();
                //let url = node.a_attr.href;
                let url =
                  "/wp-admin/term.php?taxonomy=" +
                  node.a_attr.taxonomy +
                  "&tag_ID=" +
                  node.a_attr.tag_id +
                  "&post_type=" +
                  node.a_attr.post_type;
                window.open(url);
              },
              icon: "dashicons dashicons-edit",
            },
            copy_sku: {
              separator_before: true,
              separator_after: false,
              label: "Copy suggested SKU",
              action: function action(obj) {
                var text = $(
                  "#" + $(node).attr("id") + "_anchor" + " .suggested-sku"
                ).text();
                window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
              },
              icon: "dashicons dashicons-welcome-add-page",
            },
            copy_cat_name: {
              separator_before: true,
              separator_after: false,
              label: "Copy category name",
              action: function action(obj) {
                var text = $(
                  "#" + $(node).attr("id") + "_anchor" + " .atr-cm-cat-name"
                ).text();
                window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
              },
              icon: "dashicons dashicons-admin-page",
            },
          };
        },
      },
    });
    $("#s").submit(function(e) {
      e.preventDefault();
      $(container)
        .jstree(true)
        .search($("#q").val());
    });
    // $(container).on("changed.jstree", function (e, core) {
    // console.log("The selected nodes are:");
    // console.log(core.selected);
    // console.log(core.instance.get_selected(true)[0].text);
    // console.log(core.instance.get_node(core.selected[0]).text);
    // });
  });
})(jQuery);
