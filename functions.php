<?php
/**
 * Theme functions and definitions
 *
 * @package fabcontroley
 */ 

if ( ! function_exists( 'fabcontroley_theme_defaults' ) ) :
	/**
	 * Customize theme defaults.
	 *
	 * @since 1.0.0
	 *
	 * @param array $defaults Theme defaults.
	 * @param array Custom theme defaults.
	 */
	function fabcontroley_theme_defaults( $defaults ) {
        $defaults['enable_slider'] = false;
        $defaults['enable_hero_content'] = false;
        $defaults['blog_column_type'] = 'column-3';
		$defaults['excerpt_count']    = 25;

		return $defaults;
	}
endif;
add_filter( 'fabulist_default_theme_options', 'fabcontroley_theme_defaults', 99 );

if ( ! function_exists( 'fabcontroley_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function fabcontroley_enqueue_styles() {

		wp_enqueue_style( 'fabcontroley-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'fabcontroley-style', get_stylesheet_directory_uri() . '/style.css', array( 'fabcontroley-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'fabcontroley_enqueue_styles', 99 );

/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function fabulist_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Work Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Work Sans font: on or off', 'fabulist' ) ) {
		$fonts[] = 'Work Sans:100,200,300,400,500,600,700,800';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'fabulist' ) ) {
			$fonts[] = 'Inconsolata:100,200,300,400,500,600,700,800';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

if ( ! function_exists( 'fabcontroley_site_info' ) ) :
	/**
	 * Site info codes
	 */
	function fabcontroley_site_info() { 
		$copyright = fabulist_theme_option('copyright_text');
		?>
		<div class="site-info">
			<div class="wrapper">
				<?php if ( ! empty( $copyright ) ) : ?>
					<div class="copyright">
						<p>
							<?php 
							echo fabulist_santize_allow_tags( $copyright ); ?>
						</p>
						<p>
							<?php
							printf( esc_html__( ' Fabulist by %1$sShark Themes%2$s. Desenvolvido por @glllcs.', 'fabulist' ), '<a href="' . esc_url( 'http://sharkthemes.com/' ) . '" target="_blank">','</a>' );
							if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( ' | ' );
							}
							?>
						</p>
					</div><!-- .copyright -->
				<?php endif; ?>
			</div><!-- .wrapper -->    
		</div><!-- .site-info -->
	<?php }
endif;
add_action( 'fabcontroley_site_info_action', 'fabcontroley_site_info', 10 );