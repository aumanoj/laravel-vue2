<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Pluto
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
if(is_home() || is_front_page()){
?>
<title><?php // is_front_page() ? bloginfo('description') : wp_title('|', true, 'right'); ?>Unlockninja - Blog Latest news update about cell phone unlocking service for all Brands</title>
<?php }else{ ?>
<title><?php wp_title('|', true, 'right'); ?></title>
<?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "267",
    "itemReviewed":
    {
        "@type": "organization",
        "name": "Unlockninja Cell Phone Unlocking Service"
    }
}
</script>

<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53768143-1', 'auto');
  ga('send', 'pageview');
</script>

</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site ss1">
		<?php do_action( 'pluto-before' ); ?>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php if((of_get_option('logo', true) != "") && (of_get_option('logo', true) != 1) ) { ?>
					<h1 class="site-title logo-container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				      <?php echo "<img class='main_logo' src='".of_get_option('logo', true)."' title='".esc_attr(get_bloginfo( 'name','display' ) )."'></a></h1>";	

				} else { ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> 

				<?php } ?>
				</div>
				<?php get_template_part('social', 'sociocon'); ?>
		</header><!-- #masthead -->
		<nav id="site-navigation" class="main-navigation" role="navigation">

			<div id="nav-container">


				<h1 class="menu-toggle"><?php _e( 'Menu', 'pluto' ); ?></h1>
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'pluto' ); ?>"><?php _e( 'Skip to content', 'pluto' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</div>  
		</nav><!-- #site-navigation -->
		<div id="content" class="site-content">
		<?php get_template_part('slider', 'bx'); ?>
