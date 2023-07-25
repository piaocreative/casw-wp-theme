<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-58E23KGV8S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-58E23KGV8S');
</script>
</head>

<style>
  a.custom-logo-link img {
    max-width: 300px;
  }
</style>
<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
  <?php do_action( 'wp_body_open' ); ?>
  <div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="wrapper-navbar">

      <nav id="main-nav" class="navbar navbar-expand-xl" aria-labelledby="main-nav-label">

        <div class="container-fluid">

          <!-- Your site title as branding in the menu -->
          <?php if ( !has_custom_logo() ) { ?>

            <?php if ( is_front_page() && is_home() ): ?>

              <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

            <?php else: ?>

              <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

            <?php endif; ?>

            <?php
          } else {
            the_custom_logo();
          }
          ?>
          <!-- end custom logo -->

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- The WordPress Menu goes here -->
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'container_class' => 'collapse navbar-collapse',
              'container_id' => 'navbarNavDropdown',
              'menu_class' => 'navbar-nav ml-auto',
              'fallback_cb' => '',
              'menu_id' => 'main-menu',
              'depth' => 2,
              'walker' => new Understrap_WP_Bootstrap_Navwalker(),
            )
          );
          ?>

      </nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->