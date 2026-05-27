<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( is_singular(array('post')) ) {
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id);
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"   content="<?php echo get_permalink(); ?>" />
<meta property="og:type"  content="article" />
<meta property="og:title" content="<?php echo get_the_title(); ?>" />
<meta property="og:description" content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image" content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100..900;1,100..900&family=Zalando+Sans+Expanded:ital,wght@0,200..900;1,200..900&family=Zalando+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div id="page" class="site">
    <?php
      $tagline = get_field('tagline', 'option');
      $restaurant_logos = get_field('restaurant_logos', 'option');
    ?>
    <a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>
    <header id="masthead" class="site-header">
      <div class="header-inner">
        <span class="site-logo">
          <?php if( get_custom_logo() ) { ?>
            <?php the_custom_logo(); ?>
          <?php } else { ?>
            <a hef="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
          <?php } ?>
          <?php if( is_front_page() || is_home() ) { ?>
            <?php if ($tagline) { ?>
            <div class="header-tagline"><?php echo $tagline ?></div>
            <?php } ?>
          <?php } ?>
        </span>

        <button class="menu-toggle" aria-expanded="false" aria-controls="#primary-navigation">
          <span class="sr">Menu Toggle</span>
          <span class="bar"><span></span></span>
        </button>

        <?php
          $headCta = get_field('header_cta','option');
          $headCtaShow = ( isset($headCta['visibility']) && $headCta['visibility'] ) ? $headCta['visibility'] : '';
          $hCtaButton = ( isset($headCta['button']) && $headCta['button'] ) ? $headCta['button'] : '';
          $hCtaButtonUrl = ( isset($hCtaButton['url']) && $hCtaButton['url'] ) ? $hCtaButton['url'] : '';
          $hCtaButtonName = ( isset($hCtaButton['title']) && $hCtaButton['title'] ) ? $hCtaButton['title'] : '';
          $hCtaButtonTarget = ( isset($hCtaButton['target']) && $hCtaButton['target'] ) ? $hCtaButton['target'] : '_self';
        ?>

        <div id="primary-navigation" class="primary-navigation">
					<button class="closeMenuToggle"><span class="sr-only">Close Menu</span></button>
          <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>') ); ?>
            <?php if( $headCtaShow=='show' && ($hCtaButtonName && $hCtaButtonUrl) ) { ?>
            <a href="<?php echo $hCtaButtonUrl ?>" target="<?php echo $hCtaButtonTarget ?>" class="header-cta-button"><?php echo $hCtaButtonName ?></a>
            <?php } ?>
          </nav>
        </div>

			</div>
    </header>

		<?php if( is_front_page() || is_home() ) { ?>
		<?php get_template_part('parts/partners-top'); ?>
		<?php } ?>
		 <?php get_template_part('parts/hero'); ?>
    <div id="content" class="site-content">
