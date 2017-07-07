<?php
/**
 * Plugin Name: Stockton
 * Version: 0.1
 * Description: Displays what template a page is using on the archive page
 * Author: Chris Allen
 * Author URI: http://cpallen.com/
 * Domain Path: /languages
 * @package stockton
 */

 /**
 * Create a new column header
 *
 * @param $columns
 * @return array
 */
function cpa_template_column( $columns ) {

  $templateColumns = array(
    'template' => __( 'Template' )
  );
  $columns = array_merge( $columns, $templateColumns );
  return $columns;
}
add_filter( 'manage_pages_columns', 'cpa_template_column' );

/**
 * Add Template slug to columns
 *
 * @param $column_name
 * @param $post_id
 */
function cpa_template_column_content( $column_name, $post_id ) {

  if ( $column_name === 'template' ) {
    if( ! get_page_template_slug( $post_id ) ) {
      echo 'Default Template';
    } else {
      $current_template_file = get_post_meta( $post_id, '_wp_page_template', TRUE );
      $all_templates = get_page_templates();

      foreach ( $all_templates as $template_name => $template_filename ) {
        if( $template_filename === $current_template_file ) {
          echo $template_name;
        }
     }
    }
  }
}
add_action( 'manage_pages_custom_column', 'cpa_template_column_content', 10, 2 );
