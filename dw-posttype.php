<?php

    /**      Plugin Name: dwtask Posttype */

    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);

    register_activation_hook( __FILE__, "activate_dw_cpts");

    function activate_dw_cpts(){

        register_post_type('Projects', array(
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'excerpt'),
            'rewrite' => array('slug' => 'projects'),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
              'name' => 'Projects',
              'add_new_item' => 'Add New Project',
              'edit_item' => 'Edit Project',
              'all_items' => 'All Projects',
              'singular_name' => 'Project'
            ),
            'menu_icon' => 'dashicons-welcome-learn-more'
          ));



          dwcustom_db();
          
    }
    add_action('init', 'activate_dw_cpts');

    register_activation_hook(__FILE__, 'activate_dw_cpts');

    function dwcustom_db() {
      global $table_prefix, $wpdb;
      $dwtable = $table_prefix . 'dwtable';
      if( $wpdb->get_var( "show tables like '$dwtable'" ) != $dwtable ) {
  
      $sql = "CREATE TABLE $dwtable (
          id int(10) NOT NULL AUTO_INCREMENT,
          username VARCHAR(100), email VARCHAR(100),
          PRIMARY KEY (id)
      )";
  
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
  }
  
    }
  

    register_deactivation_hook( __FILE__, "deactivate_dw_cpts" );

    
    function deactivate_dw_cpts(){

      unregister_post_type('projects');

    }


    register_uninstall_hook(__FILE__, 'uninsta_dw_cpts');




    function uninsta_dw_cpts() {

      global $table_prefix, $wpdb;
      $dwtable = $table_prefix . 'dwtable';
      $sql = "DROP TABLE IF EXISTS $dwtable";
      $wpdb->query($sql);

      unregister_post_type('projects');



  }



    








?>