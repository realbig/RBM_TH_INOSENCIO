<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package Inosencio
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/nomin/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="site-header">

		<div class="foundation-sticky">
			<nav class="top-bar" data-topbar role="navigation">

				<section class="top-bar-section">
					<ul class="left">
						<li>
							<a href="#">
								<span class="fa fa-home"></span>
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="#">
								<span class="fa fa-envelope"></span>
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="#">
								<?php echo _inosencio_sc_phone( array( 'icon' => 'yes' ) ); ?>
							</a>
						</li>

						<li class="divider"></li>
					</ul>
				</section>

				<section class="top-bar-section">
					<ul class="right">
						<li class="divider"></li>

						<li class="has-search">
							<form class="search row collapse" action="<?php bloginfo( 'url' ); ?>" method="get">
								<div class="small-9 columns">
									<input type="search" name="s" id="top-bar-search"
									       data-placeholder="What are you searching for?">
								</div>
								<div class="text-right small-3 columns">
									<a href="#top-bar-search" class="search-button"><span
											class="fa fa-search"></span></a>
								</div>
							</form>
						</li>

						<li class="show-for-small-only">
							<a href="#" class="toggle-nav">
								<span class="fa fa-bars"></span>
							</a>
						</li>
					</ul>
				</section>

			</nav>

			<nav id="mobile-nav">
				<?php
				wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				) );
				?>
			</nav>
		</div>

		<div class="logo-menu row">
			<section class="site-logo columns small-12 medium-3 large-4">
				<a href="<?php bloginfo( 'url' ); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-logo.png"
					     alt="inosencio fisk"/>
				</a>
			</section>

			<nav class="site-nav columns medium-9 large-8 show-for-medium-up">
				<?php
				add_filter( 'the_title', '_inosencio_header_nav_filter' );

				function _inosencio_header_nav_filter( $title ) {
					return "<span data-hover=\"$title\">$title</span>";
				}

				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
				) );

				remove_filter( 'the_title', '_inosencio_header_nav_filter' );
				?>
			</nav>
		</div>

		<?php do_action( 'inosencio_before_page_title' ); ?>

		<?php if ( $title = apply_filters( 'inosencio_page_title', get_the_title() ) ) : ?>
			<h1 class="page-title text-center">
				<?php echo $title; ?>
			</h1>
		<?php endif; ?>

		<?php do_action( 'inosencio_after_page_title' ); ?>

	</header>

	<section id="site-content">