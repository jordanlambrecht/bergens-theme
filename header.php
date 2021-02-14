<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BergensTheme
 */

?>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script type="application/ld+json">
	{
	  "@context": "https://schema.org/",
	  "@type": "Person",
	  "name": "Bergen Johnston",
	  "url": "https://bergenjohnston.com",
	  "image": "https://media.pixelbakery.com/wp-content/uploads/2020/12/22043155/Screen-Shot-2020-12-21-at-10.31.51-PM.png",
	  "sameAs": [
	    "https://www.facebook.com/bergen.johnston",
	    "https://www.instagram.com/bergenjohnston/",
	    "https://www.linkedin.com/in/bergen-johnston-ab9a29a8/",
	    "https://twitter.com/BergenJohnston"
	  ],
	  "jobTitle": "Photographer"
	}
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'bergenstheme' ); ?></a>
