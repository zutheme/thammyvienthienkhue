<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $porto_settings, $porto_layout, $woocommerce_loop;

$cols = $porto_settings['product-cols'];
$addlinks_pos = $porto_settings['category-addlinks-pos'];

if (isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'])
    $cols = $woocommerce_loop['columns'];

$woocommerce_loop['product_loop'] = 0;
$woocommerce_loop['cat_loop'] = 0;

if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') {
    if ($cols == 8 || $cols == 7)
        $cols = 6;
}

$item_width = $cols;
if (isset($woocommerce_loop['column_width']) && $woocommerce_loop['column_width'])
    $item_width = $woocommerce_loop['column_width'];

switch ($cols) {
    case 1: $cols_md = 1; $cols_xs = 1; $cols_ls = 1; break;
    case 2: $cols_md = 2; $cols_xs = 2; $cols_ls = 1; break;
    case 3: $cols_md = 3; $cols_xs = 2; $cols_ls = 1; break;
    case 4: $cols_md = 3; $cols_xs = 2; $cols_ls = 1; break;
    case 5: $cols_md = 4; $cols_xs = 2; $cols_ls = 1; break;
    case 6: $cols_md = 5; $cols_xs = 3; $cols_ls = 2; break;
    case 7: $cols_md = 6; $cols_xs = 3; $cols_ls = 2; break;
    case 8: $cols_md = 6; $cols_xs = 3; $cols_ls = 2; break;
    default: $cols = 4; $cols_md = 3; $cols_xs = 2; $cols_ls = 1;
}

if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') {
    switch ($cols) {
        case 5: $cols_xs = 3; $cols_ls = 2; break;
    }
}

switch ($item_width) {
    case 1: $item_width_md = 1; $item_width_xs = 1; $item_width_ls = 1; break;
    case 2: $item_width_md = 2; $item_width_xs = 1; $item_width_ls = 1; break;
    case 3: $item_width_md = 3; $item_width_xs = 2; $item_width_ls = 1; break;
    case 4: $item_width_md = 3; $item_width_xs = 2; $item_width_ls = 1; break;
    case 5: $item_width_md = 4; $item_width_xs = 2; $item_width_ls = 1; break;
    case 6: $item_width_md = 5; $item_width_xs = 3; $item_width_ls = 2; break;
    case 7: $item_width_md = 6; $item_width_xs = 3; $item_width_ls = 2; break;
    case 8: $item_width_md = 6; $item_width_xs = 3; $item_width_ls = 2; break;
    default: $item_width = 4; $item_width_md = 3; $item_width_xs = 2; $item_width_ls = 1;
}

if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') {
    switch ($item_width) {
        case 5: $item_width_xs = 3; $item_width_ls = 2; break;
    }
}

if (!isset($woocommerce_loop['addlinks_pos']) || !$woocommerce_loop['addlinks_pos'])
    $woocommerce_loop['addlinks_pos'] = $addlinks_pos;

global $porto_products_cols_lg, $porto_products_cols_md, $porto_products_cols_xs, $porto_products_cols_ls;
$porto_products_cols_lg = $cols;
$porto_products_cols_md = $cols_md;
$porto_products_cols_xs = $cols_xs;
$porto_products_cols_ls = $cols_ls;

$classes = array('products');
if (isset($woocommerce_loop['widget']) && $woocommerce_loop['widget'])
    $classes[] = 'product_list_widget';

if (isset($woocommerce_loop['view']) && $woocommerce_loop['view']) {
    $classes[] = $woocommerce_loop['view'];
    if ($woocommerce_loop['view'] === 'products-slider' || $woocommerce_loop['view'] === 'product-carousel')
        $classes[] = 'owl-carousel show-nav-title';
}

if (isset($woocommerce_loop['category-view']) && $woocommerce_loop['category-view'])
    $classes[] = $woocommerce_loop['category-view'];

$classes[] = 'pcols-lg-' . $cols;
if (!(isset($woocommerce_loop['view']) && $woocommerce_loop['view'] == 'product-carousel')) $classes[] = 'pcols-md-' . $cols_md;
$classes[] = 'pcols-xs-' . $cols_xs;
$classes[] = 'pcols-ls-' . $cols_ls;
$classes[] = 'pwidth-lg-' . $item_width;
if (!(isset($woocommerce_loop['view']) && $woocommerce_loop['view'] == 'product-carousel')) $classes[] = 'pwidth-md-' . $item_width_md;
$classes[] = 'pwidth-xs-' . $item_width_xs;
$classes[] = 'pwidth-ls-' . $item_width_ls;
?>
<ul class="<?php echo implode(' ', $classes) ?>"<?php
if (isset($woocommerce_loop['view']) && $woocommerce_loop['view'] == 'products-slider') : ?> data-cols-lg="<?php echo $cols
    ?>" data-cols-md="<?php echo $cols_md
    ?>" data-cols-xs="<?php echo $cols_xs
    ?>" data-cols-ls="<?php echo $cols_ls
    ?>"<?php if (isset($woocommerce_loop['navigation']) && $woocommerce_loop['navigation']) echo ' data-navigation="1"'
    ?><?php if (isset($woocommerce_loop['pagination']) && $woocommerce_loop['pagination']) echo ' data-pagination="1"'
    ?><?php endif;
if (isset($woocommerce_loop['view']) && $woocommerce_loop['view'] == 'product-carousel') : ?> data-cols-lg="<?php echo $cols
?>" data-cols-md="<?php echo $cols_md
?>" data-cols-sm="<?php echo $cols_xs
?>"<?php endif; ?>>