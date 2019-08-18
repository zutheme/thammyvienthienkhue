<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product, $porto_settings;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( !count($attachment_ids) ) {
    $porto_settings['product-thumbs'] = false;
}

?>
<div class="product-images images">
    <?php
    $html = '<div class="product-image-slider owl-carousel show-nav-hover">';

    if ( has_post_thumbnail() ) {

        $attachment_id = get_post_thumbnail_id();
        $image_title = esc_attr( get_the_title( $attachment_id ) ); if (!$image_title) $image_title = '';
        $image_link  = wp_get_attachment_url( $attachment_id );
        $image_single_link = wp_get_attachment_image_src($attachment_id, 'shop_single');

        $html .= '<div class="img-thumbnail"><div class="inner">';
        $html .= '<img src="' . $image_single_link[0] . '" href="' . $image_link . '" class="woocommerce-main-image img-responsive" alt="' . $image_title . '" itemprop="image" content="' . $image_link . '" />';
        $html .= '</div></div>';

    } else {

        $image_link = wc_placeholder_img_src();
        $html .= '<div class="img-thumbnail"><div class="inner">';
        $html .= '<img src="' . $image_link . '" alt="" href="' . $image_link . '" class="woocommerce-main-image img-responsive" itemprop="image" content="' . $image_link . '" />';
        $html .= '</div></div>';
    }

    if ( $attachment_ids ) {
        foreach ( $attachment_ids as $attachment_id ) {

            $image_link = wp_get_attachment_url( $attachment_id );

            if ( ! $image_link )
                continue;

            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
            $image_link  = wp_get_attachment_url( $attachment_id );
            $image_single_link = wp_get_attachment_image_src($attachment_id, 'shop_single');
            $image_title = esc_attr( get_the_title( $attachment_id ) ); if (!$image_title) $image_title = '';

            $html .= '<div class="img-thumbnail"><div class="inner">';
            $html .= '<img src="' . $image_single_link[0] . '" href="' . $image_link . '" class="img-responsive" alt="' . $image_title . '" itemprop="image" content="' . $image_link . '" />';
            $html .= '</div></div>';

        }
    }

    $html .= '</div>';

    if ($porto_settings['product-image-popup'])
        $html .= '<span class="zoom" data-index="0"><i class="fa fa-search"></i></span>';

    echo apply_filters( 'woocommerce_single_product_image_html', $html, $post->ID );

    ?>
</div>

<?php
if (!porto_is_ajax() && $porto_settings['product-thumbs']) {
    do_action( 'woocommerce_product_thumbnails' );
}
?>
