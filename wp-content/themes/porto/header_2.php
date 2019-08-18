<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php get_template_part('head'); ?>
</head>
<?php
global $porto_settings, $porto_design;
$wrapper = porto_get_wrapper_type();
$body_class = $wrapper;
$body_class .= ' blog-' . get_current_blog_id();
$body_class .= porto_is_dark_skin() ? ' dark' : '';

$header_type = porto_get_header_type();

if ($header_type == 'side')
    $body_class .=  ' body-side';

$loading_overlay = porto_get_meta_value('loading_overlay');
$showing_overlay = false;
if ('no' !== $loading_overlay && ('yes' === $loading_overlay || ('yes' !== $loading_overlay && $porto_settings['show-loading-overlay']))) {
    $showing_overlay = true;
    $body_class .= ' loading-overlay-showing';
}

?>
<body <?php body_class(array($body_class)); ?><?php echo $showing_overlay ? 'data-loading-overlay' : '' ?>>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a28e580d0795768aaf8dd94/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110812630-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110812630-1');
</script>

    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=215677805452972';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <?php
    // Showing Overlay
    if ($showing_overlay) : ?><div class="loading-overlay"><div class="loader"></div></div><?php
    endif;

    // Get Meta Values
    wp_reset_postdata();
    global $porto_layout, $porto_sidebar;

    $porto_layout = porto_meta_layout();
    $porto_sidebar = porto_meta_sidebar();
    $porto_banner_pos = porto_get_meta_value('banner_pos');
    if (($porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && !(($porto_sidebar && is_active_sidebar( $porto_sidebar )) || porto_have_sidebar_menu())) {
        $porto_layout = 'fullwidth';
    }
    if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') && !(($porto_sidebar && is_active_sidebar( $porto_sidebar )) || porto_have_sidebar_menu())) {
        $porto_layout = 'widewidth';
    }

    $breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
    $page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;
    $content_top = porto_get_meta_value('content_top');
    $content_inner_top = porto_get_meta_value('content_inner_top');

    if (( is_front_page() && is_home()) || is_front_page() ) {
        $breadcrumbs = false;
        $page_title = false;
    }

    do_action('porto_before_wrapper');
    ?>

    <div class="page-wrapper<?php if ($header_type == 'side') echo ' side-nav' ?>"><!-- page wrapper -->

        <?php
        if ($porto_banner_pos == 'before_header') {
            porto_banner('banner-before-header');
        }
        do_action('porto_before_header');
        ?>

        <?php if (porto_get_meta_value('header', true)) : ?>
            <div class="header-wrapper<?php if ($porto_settings['header-wrapper'] == 'wide') echo ' wide' ?><?php if (!($header_type == 'side' && $wrapper == 'boxed') && ($porto_banner_pos == 'below_header' || $porto_banner_pos == 'fixed')) { echo ' fixed-header'; if ($porto_settings['header-fixed-show-bottom']) echo ' header-transparent-bottom-border'; } ?><?php if ($header_type == 'side') echo ' header-side-nav' ?> clearfix"><!-- header wrapper -->
                <?php
                global $porto_settings;
                ?>
                <?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['header-wrapper'] == 'boxed') : ?>
                <div id="header-boxed">
                <?php endif; ?>

                    <?php
                    get_template_part('header/header_'.$header_type);
                    ?>

                <?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['header-wrapper'] == 'boxed') : ?>
                </div>
                <?php endif; ?>
            </div><!-- end header wrapper -->
        <?php endif; ?>

        <?php
        do_action('porto_before_banner');
        if ($porto_banner_pos != 'before_header') {
            porto_banner(($porto_banner_pos == 'fixed' && 'boxed' !== $wrapper) ? 'banner-fixed' : '');
        }
        ?>

        <?php
        do_action('porto_before_breadcrumbs');
        get_template_part('breadcrumbs');
        do_action('porto_before_main');
        ?>

        

        <div id="main" class="<?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'column2' . ' column2-' . str_replace('wide-', '', $porto_layout); else echo 'column1'; ?><?php if ($porto_layout == 'widewidth' || $porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') echo ' wide clearfix'; else echo ' boxed' ?><?php if (!$breadcrumbs && !$page_title) echo ' no-breadcrumbs' ?><?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['main-wrapper'] == 'boxed') echo ' main-boxed' ?>"><!-- main -->

            <?php
            do_action('porto_before_content_top');
            if ($content_top) : ?>
            <div id="content-top"><!-- begin content top -->
                    <?php foreach (explode(',', $content_top) as $block) {
                        echo do_shortcode('[porto_block name="'.$block.'"]');
                    } ?>
            </div><!-- end content top -->
            <?php endif;
            do_action('porto_after_content_top');
            ?>

            <?php if ($wrapper == 'boxed' || $porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') : ?>
            <div class="container">
                
                <?php if(is_category()){
                    //echo 'cate';
                    echo do_shortcode('[top_chuyen_muc]'); 
                    
                } ?>
            
                <div class="row">
            <?php endif; ?>

            <!-- main content -->
            <div class="main-content <?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'col-md-9'; else echo 'col-md-12'; ?>">

            <?php wp_reset_postdata(); ?>
                <?php
                do_action('porto_before_content_inner_top');
                if ($content_inner_top) : ?>
                    <div id="content-inner-top"><!-- begin content inner top -->
                        <?php foreach (explode(',', $content_inner_top) as $block) {
                            echo do_shortcode('[porto_block name="'.$block.'"]');
                        } ?>
                    </div><!-- end content inner top -->
                <?php endif;
                do_action('porto_after_content_inner_top');
                ?>