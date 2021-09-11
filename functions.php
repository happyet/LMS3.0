<?php
function lmsim_load() {
    register_nav_menus( array(
		'topbar' => 'Main Menu',
	) );
	add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 260,
		'flex-height' => true,
	) );
    add_theme_support( 'custom-background' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );	
}
add_action( 'after_setup_theme', 'lmsim_load' );
function lmsim_widgets_init() {
    register_sidebar(array(
    	'id' => 'sidebar-1',
        'name' => 'Widget Area',
        'before_widget' => '<div class="side-box my-4 pb-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'lmsim_widgets_init' );
function add_scripts() {
    wp_enqueue_style( 'lmsim', get_stylesheet_uri() );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'add_scripts');
function lms_auto_excerpt_more( $more ) {
    return ' &hellip;';
}
add_filter( 'excerpt_more', 'lms_auto_excerpt_more' );
function lmsim_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'lmsim_excerpt_length' );
function get_cn_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cravatar.cn", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'get_cn_avatar');
function lmsim_record_views() {
    if (is_singular()) {
        global $post, $user_ID;
        $post_ID = $post->ID;
        if (empty($_COOKIE[USER_COOKIE]) && intval($user_ID) == 0) {
            if ($post_ID) {
                $post_views = (int)get_post_meta($post_ID, 'views', true);
                if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                    add_post_meta($post_ID, 'views', 1, true);
                }
            }
        }
    }
}
add_action('wp_head', 'lmsim_record_views');
function post_views($before = '', $after = '', $echo = 1) {
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) {
        echo $before, number_format($views) , $after;
    } else {
        return $views;
    }
}
function lmsim_theme_views(){
	if(function_exists('the_views')) { 
		echo the_views(false); 
	}else{ 
		post_views();
	}
}
/*
默认侧栏最新评论排除博主
查看wp-includes/comment.php中WP_Comment_Query::query部分
根据传入参数完善查询条件
*/
add_filter( 'comments_clauses', 'wpdit_comments_clauses', 2, 10);
function wpdit_comments_clauses( $clauses, $comments ) {
    global $wpdb;
    if ( isset( $comments->query_vars['not_in__user'] ) && ( $user_id = $comments->query_vars['not_in__user'] ) ) {
         
        if ( is_array( $user_id ) ) {
            $clauses['where'] .= ' AND user_id NOT IN (' . implode( ',', array_map( 'absint', $user_id ) ) . ')';
        } elseif ( '' !== $user_id ) {
            $clauses['where'] .= $wpdb->prepare( ' AND user_id <> %d', $user_id );
        }
    }
    //var_dump($clauses);
    return $clauses;
}
/*
默认侧栏最新评论排除博主
详细查看wp-includes/default-widgets.php中 WP_Widget_Recent_Comments 部分
增加参数not_in__user
*/
add_filter( 'widget_comments_args', 'wpdit_widget_comments_args' );
function wpdit_widget_comments_args( $args ){
    $args['not_in__user'] = array(1); //这里放你的ID；
    return $args;
}
function hide_admin_bar($flag){
    return false;
}
function lmsim_noself_ping(&$links){
    $home = get_option('home');
    foreach ($links as $l => $link) {
      if (0 === strpos($link, $home)) {
        unset($links[$l]);
      }
    }
}
function search_filter_page($query){
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }
    return $query;
}
function comment_links_in_new_tab($text) {
      $return = str_replace('<a', '<a target="_blank"', $text);
      return $return;
}
add_filter('get_comment_author_link', 'comment_links_in_new_tab');
add_action('pre_ping', 'lmsim_noself_ping');
add_filter('show_admin_bar', 'hide_admin_bar');
add_filter('pre_get_posts', 'search_filter_page');
add_filter('use_default_gallery_style', '__return_false');
add_filter('pre_option_link_manager_enabled', '__return_true');
function lmsim_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$description = get_bloginfo( 'description', 'display' );
	if($custom_logo_id){
		$html = sprintf(
			'<div class="logo img-logo"><a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a></div>',
			esc_url( home_url( '/' ) ),
			wp_get_attachment_image( $custom_logo_id, 'full', false, array(
				'class'    => 'custom-logo',
				'itemprop' => 'logo',
				'alt'			 => get_bloginfo( 'name' ),
				'title'		 => $description
			) )
		);
	}else{
		$html = '<div class="logo text-logo"><h1><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
		if ( $description || is_customize_preview() )
			$html .= '<p class="site-description">' . $description . '</p>';
		$html .= '</div>';
	}
	echo $html;
}