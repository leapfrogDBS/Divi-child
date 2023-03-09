<?php
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css?v=121198' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

add_filter( 'auto_update_plugin', '__return_true' );

add_filter( 'auto_update_theme', '__return_true' ); 

add_shortcode ('woo_cart_but', 'woo_cart_but' );

add_filter( 'et_pb_portfolio_image_height', 'portfolio_size_h' );
add_filter( 'et_pb_portfolio_image_width', 'portfolio_size_w' );
 
function portfolio_size_h($height) {
	return '200';
}
 
function portfolio_size_w($width) {
	return '400';
}
 
add_image_size( 'custom-portfolio-size', 400, 200 );
// End custom image size for Portfolio Module

remove_action('wp_head', 'wp_generator');
function remove_wp_version_rss() { return''; }
add_filter('the_generator','remove_wp_version_rss');

add_filter('woocommerce_add_to_cart_redirect','straight_to_checkout');
function straight_to_checkout() {
   $checkouturl = WC()->cart->get_checkout_url();
   return $checkouturl;
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
return __( 'Buy Website Tune-up', 'woocommerce' );
}
// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );
function woocommerce_custom_product_add_to_cart_text() {
return __( 'Buy Website Tune-up', 'woocommerce' );
}

function wpb_hook_javascript() {
  if (is_page ('8444')) { 
    ?>
        <script>
jQuery(function($) {
window.et_pb_smooth_scroll = function( $target, $top_section, speed, easing ) {
var $window_width = $( window ).width();
$menu_offset = -1;
var headerHeight = 143;
if ( $ ('#wpadminbar').length && $window_width <= 980 ) {
$menu_offset += $( '#wpadminbar' ).outerHeight() + headerHeight;
} else {
$menu_offset += headerHeight;
}
//fix sidenav scroll to top
if ( $top_section ) {
$scroll_position = 0;
} else {
$scroll_position = $target.offset().top - $menu_offset;
}
// set swing (animate's scrollTop default) as default value
if( typeof easing === 'undefined' ){
easing = 'swing';
}
$( 'html, body' ).animate( { scrollTop : $scroll_position }, speed, easing );
}
});
jQuery(function($){
    $('.et_pb_accordion .et_pb_toggle_open').addClass('et_pb_toggle_close').removeClass('et_pb_toggle_open');

    $('.et_pb_accordion .et_pb_toggle').click(function() {
      $this = $(this);
      setTimeout(function(){
         $this.closest('.et_pb_accordion').removeClass('et_pb_accordion_toggling');
      },700);
    });
});
</script>
    <?php
  }
}
add_action('wp_head', 'wpb_hook_javascript');


