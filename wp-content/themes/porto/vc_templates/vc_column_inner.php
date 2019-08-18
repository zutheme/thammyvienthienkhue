<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 *
 * Extra Params
 * @var $is_sticky
 * @var $sticky_container_selector
 * @var $sticky_min_width
 * @var $sticky_top
 * @var $sticky_bottom
 * @var $sticky_active_class
 * @var $animation_type
 * @var $animation_duration
 * @var $animation_delay
 *
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$el_class = $this->getExtraClass( $el_class );

if ($animation_type)
    $el_class .= ' appear-animation';

$css_classes = array(
	$el_class,
	//'wpb_column',
	'vc_column_container',
	$width,
	vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if ($animation_type)
    $wrapper_attributes[] = 'data-appear-animation="'.$animation_type.'"';
if ($animation_delay)
    $wrapper_attributes[] = 'data-appear-animation-delay="'.$animation_delay.'"';
if ($animation_duration && $animation_duration != 1000)
    $wrapper_attributes[] = 'data-appear-animation-duration="'.$animation_duration.'"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ($is_sticky) {
    $output .= '<div class="porto-sticky"';
    if ($sticky_container_selector)
        $output .= ' data-container-selector="'.$sticky_container_selector.'"';
    if ($sticky_min_width)
        $output .= ' data-min-width="'.$sticky_min_width.'"';
    if ($sticky_top)
        $output .= ' data-top="'.$sticky_top.'"';
    if ($sticky_bottom)
        $output .= ' data-bottom="'.$sticky_bottom.'"';
    if ($sticky_active_class)
        $output .= ' data-active-class="'.$sticky_active_class.'"';
    $output .= '>';
}

$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';

if ($is_sticky) {
    $output .= '</div>';
}

$output .= '</div>';

echo $output;