=== Plugin Name ===
Contributors: yehudaTiram
Donate link: http://atarimtr.com
Tags: Wordpress, Woocommerce, SKU, categories
Requires at least: 3.0.1
Tested up to: 4.9.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wordpress shortcode to display collapsible treeview list of taxonomies with a combined cat IDS in the format of xxx-xxx-xxx

== Description ==

Dispaly collapsible treeview of taxonomies with a string that joins the taxonomies IDs in the same hierarchy in a format of xxx-xxx-xxx.
This shortcode is used to provide a short way of selecting a SKU (catalog number) for Woocommerce products based on their category IDS. 
The string provided is a join of all the hierarchy of categories the product is set to.

The treeview uses jsTree - v3.3.5 https://www.jstree.com/ with client side search

You should use it in a private/protected post if you want to use it only for admins.

== Usage: ==

Write a shortcode in the format:

[atr_cm_tree taxonomy_t="TAXONOMY_NAME" post_type_t=POST_TYPE uncollapse_all=TRUE]

=== Examples: ===

Display Woocommerce products categories:
[atr_cm_tree taxonomy_t="product_cat" post_type_t=product uncollapse_all=true]

Display deafult WP categories:
[atr_cm_tree taxonomy_t="category" post_type_t=post uncollapse_all=true]

Display custom post type (CPT). In this case I show a CPT taxonomy name "businesses_categories" in the post type "businesses" 
[atr_cm_tree taxonomy_t="businesses_categories" post_type_t=businesses uncollapse_all=true]
