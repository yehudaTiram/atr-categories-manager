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

	// public function render_atr_cm_list( $content){
		// if(is_single( '1' )) { // show it in post id = 1 #TODO Set as settings option
			// add_filter('the_content', array( $this, 'filter_content'));
		// }
	// }
	// public function filter_content(){
		// echo $this->atr_cm_list();
	// }
	
	/**
	 * Loop through categories and display a hierarchical list with names and IDs
	 * the main loop code from https://stackoverflow.com/questions/21009516/get-categories-from-wordpress-woocommerce
	 *
	 * @since    1.0.0
	 */
	 
    //atr_cm_list( 0 ); // the function call; 0 for all categories; or cat ID  

	public function atr_cm_list( $cat, $suggested_sku ) {
		
	  $taxonomy     = 'product_cat';
	  $orderby      = 'name';  
	  $show_count   = 0;      // 1 for yes, 0 for no
	  $pad_counts   = 0;      // 1 for yes, 0 for no
	  $hierarchical = 1;      // 1 for yes, 0 for no  
	  $title        = '';  
	  $empty        = 0;

	  $args = array(
			 'taxonomy'     => $taxonomy,
			 'orderby'      => $orderby,
			 'show_count'   => $show_count,
			 'pad_counts'   => $pad_counts,
			 'hierarchical' => $hierarchical,
			 'title_li'     => $title,
			 'hide_empty'   => $empty,
			 'parent'		=> $cat
	  );

	  $next = get_categories( $args );

	  if( $next ) :    
		foreach( $next as $cat ) :
		$suggested_sku .= '-';
		$suggested_sku .= $cat->term_id;
		echo '<ul>';
		echo '<li class="atr-cm-sub0_category"><a href="'. $cat->slug .'">' . $cat->name . ' Cat id = <span class="atr-cm-sub1-cat-id atr-cm-sub-cat-id">(' . $cat->term_id. ') </span>suggested SKU:<span class="atr-cm-sub1-sku atr-cm-sub-sku">' . $suggested_sku . '</span>' .'</a> </span>';
		echo ' / <a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>View ( '. $cat->count . ' posts )</a>  '; 
		echo ' / <a href="'. get_admin_url().'edit-tags.php?action=edit&taxonomy=category&tag_ID='.$cat->term_id.'&post_type=post" title="Edit Category">Edit</a>'; 
		$this->atr_cm_list( $cat->term_id, $suggested_sku );
		echo '</li></ul>';
		endforeach;    
	  endif;

	  
	}	


	
	public function atr_cm_list_old(  ) {
	  if( current_user_can( 'administrator' ) ) {
	  $taxonomy     = 'product_cat';
	  $orderby      = 'name';  
	  $show_count   = 0;      // 1 for yes, 0 for no
	  $pad_counts   = 0;      // 1 for yes, 0 for no
	  $hierarchical = 1;      // 1 for yes, 0 for no  
	  $title        = '';  
	  $empty        = 0;

	  $args0 = array(
			 'taxonomy'     => $taxonomy,
			 'orderby'      => $orderby,
			 'show_count'   => $show_count,
			 'pad_counts'   => $pad_counts,
			 'hierarchical' => $hierarchical,
			 'title_li'     => $title,
			 'hide_empty'   => $empty
	  );
	 $all_categories = get_categories( $args0 );//var_dump($all_categories);
	 ?>
	 <div class="input-group"><input type="text" class="form-control" placeholder="Search node .." id="search"><span class="input-group-btn"><button class="btn btn-default" type="button" id="btn-search">Go!</button></span></div>
	<input type="button" value="Collapse All" onclick="jQuery('.atr-cm-wrap').jstree('close_all');">
	<input type="button" value="Expand All" onclick="jQuery('.atr-cm-wrap').jstree('open_all');">	 
	 <?php
	 echo '<div class="atr-cm-wrap"><ul>';
	 foreach ($all_categories as $sub0_category) {
		if($sub0_category->category_parent == 0) {
			$category_id = $sub0_category->term_id;       
			echo '<li class="atr-cm-sub0_category"><a href="'. get_term_link($sub0_category->slug, 'product_cat') .'">' . $sub0_category->name . ' Cat id = <span class="atr-cm-sub1-cat-id atr-cm-sub-cat-id">(' . $sub0_category->term_id. ') </span>suggested SKU:<span class="atr-cm-sub1-sku atr-cm-sub-sku">' . $sub0_category->term_id . '</span>' .'</a> </span>';

			$args1 = array(
					'taxonomy'     => $taxonomy,
					'child_of'     => 0,
					'parent'       => $category_id,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty
			);
			$sub1_cats = get_categories( $args1 );
			if($sub1_cats) {
				echo '<ul>';
				foreach($sub1_cats as $sub1_category) {
					echo  '<li class="atr-cm-sub1_category">' . $sub1_category->name . ' Cat id = <span class="atr-cm-sub1-cat-id atr-cm-sub-cat-id">(' . $sub1_category->term_id. ') </span>suggested SKU:<span class="atr-cm-sub1-sku atr-cm-sub-sku">' . $sub0_category->term_id . '-' . $sub1_category->term_id . '</span>';
						$args2 = array(
								'taxonomy'     => $taxonomy,
								'child_of'     => 0,
								'parent'       => $sub1_category->term_id,
								'orderby'      => $orderby,
								'show_count'   => $show_count,
								'pad_counts'   => $pad_counts,
								'hierarchical' => $hierarchical,
								'title_li'     => $title,
								'hide_empty'   => $empty
						);
						$sub2_cats = get_categories( $args2 );
						echo '<ul>';
						foreach($sub2_cats as $sub2_category) {						
							echo  '<li class="atr-cm-sub2_category">' . $sub2_category->name . ' <span class="atr-cm-sub2-cat-id atr-cm-sub-cat-id">(Cat id = ' . $sub2_category->term_id . ') </span> suggested SKU:<span class="atr-cm-sub2-sku atr-cm-sub-sku">' . $sub0_category->term_id . '-' . $sub1_category->term_id . '-' . $sub2_category->term_id . '</span>';
								$args3 = array(
										'taxonomy'     => $taxonomy,
										'child_of'     => 0,
										'parent'       => $sub2_category->term_id,
										'orderby'      => $orderby,
										'show_count'   => $show_count,
										'pad_counts'   => $pad_counts,
										'hierarchical' => $hierarchical,
										'title_li'     => $title,
										'hide_empty'   => $empty
								);
								$sub3_cats = get_categories( $args3 );
								echo '<ul>';
								foreach($sub3_cats as $sub3_category) {
									echo  '<li class="atr-cm-sub3_category">' . $sub3_category->name . ' <span class="atr-cm-sub3-cat-id atr-cm-sub-cat-id">(Cat id = ' . $sub3_category->term_id . ') </span> suggested SKU:<span class="atr-cm-sub3-sku atr-cm-sub-sku">' . $sub0_category->term_id . '-' . $sub1_category->term_id . '-' . $sub2_category->term_id . '-' . $sub3_category->term_id . '</span>';
										$args4 = array(
												'taxonomy'     => $taxonomy,
												'child_of'     => 0,
												'parent'       => $sub3_category->term_id,
												'orderby'      => $orderby,
												'show_count'   => $show_count,
												'pad_counts'   => $pad_counts,
												'hierarchical' => $hierarchical,
												'title_li'     => $title,
												'hide_empty'   => $empty
										);
										$sub4_cats = get_categories( $args4 );	
										echo '<ul>';
											foreach($sub4_cats as $sub4_category) {
												echo  '<li class="atr-cm-sub4_category">' . $sub4_category->name . ' <span class="atr-cm-sub2-cat-id atr-cm-sub-cat-id">(Cat id = ' . $sub4_category->term_id . ') </span> suggested SKU<span class="atr-cm-sub4-sku atr-cm-sub-sku">:' . $sub0_category->term_id . '-' . $sub1_category->term_id . '-' . $sub2_category->term_id . '-' . $sub3_category->term_id  . '-' . $sub4_category->term_id . '</span></li>' ;
											}
										echo '</ul>';
									echo '</li>';
								}
								echo '</ul>';
							echo '</li>';
						}
						echo '</ul>';
					echo '</li>';
				};
				echo '</ul>';
			}
		}       
		echo '</li>';
		}
	echo '</ul></div>';
			
			

		}
	}
	
	/**
	 * Shortcode that renders the categories tree.
	 *
	 * @since    1.0.0
	 */
	public function atr_cm_list_sc( $atts ) {
		$a = shortcode_atts( array(
			'imageslider-id'			=> 'imageslider',
			'imageslider-class'			=> 'imageslider',
			'slide-item-class'			=> 'imageslider-item',
			'slider-container-id'		=> 'products-slider',
			'slider-container-class'	=> 'content-slider',
			'slide-distance' 			=> '1',
			'slide-duration' 			=> '1',
			'resizeable'				=> 'true',
			'pause'						=> 'true',
			'reverse'					=> 'false',
			'post-type'					=> 'post',
			'posts-per-page'			=> '10',
			'taxonomy'					=> 'category',
			'terms'						=> 'uncategorized'
			
		), $atts );		
	
		//echo $this->atr_cm_list();
		?>
		<div class="input-group"><input type="text" class="form-control" placeholder="Search node .." id="search"><span class="input-group-btn"><button class="btn btn-default" type="button" id="btn-search">Go!</button></span></div>
		<input type="button" value="Collapse All" onclick="jQuery('.atr-cm-wrap').jstree('close_all');">
		<input type="button" value="Expand All" onclick="jQuery('.atr-cm-wrap').jstree('open_all');">	 
		<?php
		echo '<div class="atr-cm-wrap">';		
		echo $this->atr_cm_list(0, '');
		echo '</div>';
		//return "foo = {$a['foo']}";
	}
	

	
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/atr-categories-manager-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . 'jstree_css', plugin_dir_url( __FILE__ ) . 'js/jstree/themes/default/style.css', array(), $this->version, 'all' );

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
		wp_enqueue_script( $this->plugin_name . 'jstree_js', plugin_dir_url( __FILE__ ) . 'js/jstree/jstree.min.js', array( 'jquery' ), $this->version, false );

	}

}
