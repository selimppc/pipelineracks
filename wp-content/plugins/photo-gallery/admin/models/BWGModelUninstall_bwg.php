<?php

class BWGModelUninstall_bwg {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function delete_db_tables() {
    global $wpdb;
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_album");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_album_gallery");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_gallery");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_image");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_image_comment");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_image_rate");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_image_tag");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_option");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_theme");
    $wpdb->query("DROP TABLE " . $wpdb->prefix . "bwg_shortcode");
    delete_option("wd_bwg_version");
    delete_option("wd_bwg_theme_version");
    // Delete terms.
    $terms = get_terms('bwg_tag', array('orderby' => 'count', 'hide_empty' => 0));
    foreach ($terms as $term) {
      wp_delete_term($term->term_id, 'bwg_tag');
    }
    // Delete custom pages for galleries.
    $count_posts = wp_count_posts('bwg_gallery');
    $published_posts = $count_posts->publish;
    $posts = get_posts(array('posts_per_page' => $published_posts, 'post_type' => 'bwg_gallery'));
    foreach ($posts as $post) {
      wp_delete_post($post->ID, TRUE);
    }
    // Delete custom pages for albums.
    $count_posts = wp_count_posts('bwg_album');
    $published_posts = $count_posts->publish;
    $posts = get_posts(array('posts_per_page' => $published_posts, 'post_type' => 'bwg_album'));
    foreach ($posts as $post) {
      wp_delete_post($post->ID, TRUE);
    }
    // Delete custom pages for tags.
    $count_posts = wp_count_posts('bwg_tag');
    $published_posts = $count_posts->publish;
    $posts = get_posts(array('posts_per_page' => $published_posts, 'post_type' => 'bwg_tag'));
    foreach ($posts as $post) {
      wp_delete_post($post->ID, TRUE);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}