<?php

/**
* The admin-facing settings of the plugin. 
* Code based in https://github.com/pinoceniccola/WordPress-Plugin-Settings-API-Template
*
* @link       http://atarimtr.com
* @since      1.0.0
*
* @package    Atr_Categories_Manager
* @subpackage Atr_Categories_Manager/admin
*/

class Atr_Categories_Manager_Admin_Settings {

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
	* The text domain of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $textdomain    The current version of this plugin.
	*/	
	private $textdomain;
	/*
	* Fired during plugins_loaded (very very early),
	* so don't miss-use this, only actions and filters,
	* current ones speak for themselves.
	*/
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->textdomain = 'atr-categories-manager';		
	}

	/**
	* Add settings link to plugin list table
	* @param  array $links Existing links
	* @return array 		Modified links
	*/
	public function add_action_links( $links ) {
		//$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page='.$this->plugin_name) ) .'">Settings</a>';
		$links[] = '<a href="http://atarimtr.com" target="_blank">Description and usage</a>';		
		return $links;
	}

	
}		
