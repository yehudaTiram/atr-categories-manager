<?php

/**
* The public-facing functionality of the plugin.
*
* @link       http://atarimtr.com
* @since      1.0.0
*
* @package    Atr_Categories_Manager
* @subpackage Atr_Categories_Manager/public
*/

/**
* The public-facing functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the public-facing stylesheet and JavaScript.
*
* @package    Atr_Categories_Manager
* @subpackage Atr_Categories_Manager/public
* @author     Yehuda Tiram <yehuda@atarimtr.co.il>
*/
class Atr_Categories_Manager_Public {

	/**
	* The ID of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $plugin_name    The ID of this plugin.
	*/
	private $plugin_name;

	/**
	* The version of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $version    The current version of this plugin.
	*/
	private $version;

	/**
	* Initialize the class and set its properties.
	*
	* @since    1.0.0
	* @param      string    $plugin_name       The name of the plugin.
	* @param      string    $version    The version of this plugin.
	*/
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	* Loop through categories and display a hierarchical list with names and IDs
	*
	* @since    1.0.0
	*/

	public function atr_cm_list( $cat_parent, $suggested_sku, $taxonomy_t, $uncollapse_all ) {
		
		$orderby      = 'name';  
		$show_count   = 0;      
		$pad_counts   = 0;      
		$hierarchical = 1;       
		$title        = '';  
		$empty        = 0;

		$args = array(
		'taxonomy'     => $taxonomy_t,
		'orderby'      => $orderby,
		'show_count'   => $show_count,
		'pad_counts'   => $pad_counts,
		'hierarchical' => $hierarchical,
		'title_li'     => $title,
		'hide_empty'   => $empty,
		'parent'		=> $cat_parent
		);

		$next = get_categories( $args );

		if( $next ) :    
		foreach( $next as $cat ) :		
		$this_cat_parent = (string)$cat->category_parent;
		$last_parent_exist = strpos($suggested_sku, $this_cat_parent);

		if ( $cat->parent > 0 ) {
			
			if ( $this->endsWith($suggested_sku, $this_cat_parent) ) {
				$suggested_sku .= '-' . $cat->term_id;
			}
			else{
				$cat_id_legth = strlen( $this_cat_parent );					
				$trim_to_this_cat_parent_idx = $last_parent_exist + $cat_id_legth;
				$sub = substr($suggested_sku, 0, $trim_to_this_cat_parent_idx);	
				$suggested_sku = $sub . '-' . $cat->term_id;	
			}
			
		}
		else{
			$suggested_sku = $cat->term_id;
		}
		echo '<ul>';
		echo '<li  data-jstree=\'{"opened":' . $uncollapse_all . '}\' class="atr-cm-sub_category" data-link="'. get_category_link( $cat->term_id ) .'"><a href="'. get_category_link( $cat->term_id ) .'">' . $cat->name . ' Cat id = <span class="atr-cm-sub1-cat-id atr-cm-sub-cat-id">(' . $cat->term_id. ') </span>suggested SKU:<span class="suggested-sku atr-cm-sub-sku">' . $suggested_sku . '</span>' .'</a> </span>';
		//echo ' / <a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>View ( '. $cat->count . ' posts )</a>  '; 
		//echo ' / <a href="'. get_admin_url().'edit-tags.php?action=edit&taxonomy=category&tag_ID='.$cat->term_id.'&post_type=post" title="Edit Category">Edit</a>'; 
		$this->atr_cm_list( $cat->term_id, $suggested_sku, $taxonomy_t,$uncollapse_all );
		echo '</li></ul>';
		endforeach;    
		endif;

		
	}	

	private function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return $length === 0 || 
		(substr($haystack, -$length) === $needle);
	}
	
	/**
	* Shortcode that renders the categories tree.
	*
	* @since    1.0.0
	*/
	public function atr_cm_list_sc( $atts ) {
		$a = shortcode_atts( array(
		
		'taxonomy_t'			=> 'product_cat',
		'uncollapse_all'			=> 'true'
		
		), $atts );		
		
		?>
		<form id="s">
		  <input type="search" id="q" />
		  <button type="submit">Search</button>
		</form>
		<input type="button" value="Collapse All" onclick="jQuery('.atr-cm-wrap').jstree('close_all');">
		<input type="button" value="Expand All" onclick="jQuery('.atr-cm-wrap').jstree('open_all');">	 
		<?php
		echo '<div class="atr-cm-wrap">';		
		echo $this->atr_cm_list(0, '',$a['taxonomy_t'],$a['uncollapse_all']);
		echo '</div>';
		//return "foo = {$a['foo']}";
	}
	

	
	/**
	* Register the stylesheets for the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/atr-categories-manager-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'jstree_css', '//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css', array(), $this->version, 'all' );

	}

	/**
	* Register the JavaScript for the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function enqueue_scripts() {

		/**
		* This function is provided for demonstration purposes only.
		*
		* An instance of this class should be passed to the run() function
		* defined in Atr_Categories_Manager_Loader as all of the hooks are defined
		* in that particular class.
		*
		* The Atr_Categories_Manager_Loader will then create the relationship
		* between the defined hooks and the functions defined in this
		* class.
		*/

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/atr-categories-manager-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . 'jstree_js', '//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js', array( 'jquery' ), $this->version, false );

	}

}
