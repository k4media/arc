<?php

/*
* ARC Custom Post Types
*
* @link http://codex.wordpress.org/Function_Reference/register_post_type
*
*/
add_action( 'init', 'arc_register_post_types' );
function arc_register_post_types() {

	$labels = array(
		'name'               => _x( 'Projects', 'post type general name', 'arc' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'arc' ),
		'menu_name'          => _x( 'Projects', 'admin menu', 'arc' ),
		'name_admin_bar'     => _x( 'Projects', 'add new on admin bar', 'arc' ),
		'add_new'            => _x( 'Add New Project', 'publication', 'arc' ),
		'add_new_item'       => __( 'Add New Project', 'arc' ),
		'new_item'           => __( 'New Project', 'arc' ),
		'edit_item'          => __( 'Edit Project', 'arc' ),
		'view_item'          => __( 'View Project', 'arc' ),
		'all_items'          => __( 'All Projects', 'arc' ),
		'search_items'       => __( 'Search Projects', 'arc' ),
		'parent_item_colon'  => __( 'Parent Project:', 'arc' ),
		'not_found'          => __( 'No Projects found.', 'arc' ),
		'not_found_in_trash' => __( 'No Projects found in Trash.', 'arc' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Projects', 'arc' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'projects' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'   		 => 'dashicons-media-spreadsheet',
		'show_in_rest'		 => true,
		'supports'           => array( 'title', 'thumbnail', 'excerpt', 'editor', 'custom-fields' )
	);

	register_post_type( 'arc_projects', $args );

}

add_action( 'init', 'arc_taxonomies' );
function arc_taxonomies() {

	$labels = array(
		'name'              => _x( 'Services', 'Services', 'arc' ),
		'singular_name'     => _x( 'Service', 'Services', 'arc' ),
		'search_items'      => __( 'Search Services', 'arc' ),
		'all_items'         => __( 'All Services', 'arc' ),
		'parent_item'       => __( 'Parent Service', 'arc' ),
		'parent_item_colon' => __( 'Parent Service:', 'arc' ),
		'edit_item'         => __( 'Edit Service', 'arc' ),
		'update_item'       => __( 'Update Service', 'arc' ),
		'add_new_item'      => __( 'Add New Service', 'arc' ),
		'new_item_name'     => __( 'New Service', 'arc' ),
		'menu_name'         => __( 'Project Services', 'arc' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'arc_project_tax', array( 'arc_projects' ), $args );

	$labels = array(
		'name'              => _x( 'Clients', 'Clients', 'arc' ),
		'singular_name'     => _x( 'Client', 'Clients', 'arc' ),
		'search_items'      => __( 'Search  Clients', 'arc' ),
		'all_items'         => __( 'All  Clients', 'arc' ),
		'parent_item'       => __( 'Parent Clients', 'arc' ),
		'parent_item_colon' => __( 'Parent Clients:', 'arc' ),
		'edit_item'         => __( 'Edit Clients', 'arc' ),
		'update_item'       => __( 'Update Clients', 'arc' ),
		'add_new_item'      => __( 'Add New Client', 'arc' ),
		'new_item_name'     => __( 'New Client', 'arc' ),
		'menu_name'         => __( 'Clients', 'arc' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'arc_clients', array( 'arc_projects' ), $args );
	
}

// limit year selection
add_filter('acf/validate_value/name=years', 'arc_limit_years', 10, 4);
function arc_limit_years( $valid, $value, $field, $input ){
	
	if( !$valid ) {
		return $valid;	
	}
	if(sizeof($value) > 2) {
		$valid = 'You can only select 2 terms';
	} else {
		$valid = true;
	}
	return $valid;
	
}

// load year selection
add_filter('acf/load_field/name=years', 'acf_load_project_years');
function acf_load_project_years( $field ) {
    
    // reset choices
    $field['choices'] = array();

    $year = date("Y");

    for( $i = 2013; $i < $year+5 ; $i++ ) {
         $field['choices'][$i] = $i;
    }
    
    // return the field
    return $field;
    
}

