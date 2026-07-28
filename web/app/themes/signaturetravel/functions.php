<?php
define( 'TEMPLATE_URL', get_stylesheet_directory_uri() );
define( 'ASSET_URL', TEMPLATE_URL . '/assets/' );
define( 'ASSET_VERSION', time() );
define( 'IS_SCSS_COMPILE', true );

// define menu id
define('ST_FOOTER_MENU_1', 8);
define('ST_FOOTER_MENU_2', 9);


// define post type
define('ST_TOUR_PT', 'tour-package');
define('ST_BLOG_PT', 'blog');

// define taxonomy
define('ST_DESTI_TAXO', 'destination');
define('ST_EXPERIENCE_TAXO', 'experience');
define('ST_TOUR_TYPE', 'tour-package-type');

// Include required files
$includes = [ 
	'includes/aq_resizer.php',
	'includes/theme-options.php',
	'includes/customize-dashboard.php',
	'includes/extra-functions.php',
];

foreach ( $includes as $file ) {
	$file_path = __DIR__ . '/' . $file;
	if ( file_exists( $file_path ) ) {
		require_once $file_path;
	}
}

/**
 * Compile SCSS files if enabled.
 */
use ScssPhp\ScssPhp\Compiler;

if ( defined( 'IS_SCSS_COMPILE' ) && IS_SCSS_COMPILE && class_exists( Compiler::class) ) {
	$compiler = new Compiler();
	$compiler->setImportPaths( __DIR__ . '/assets/scss/' );
	$compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
	$cssOut = $compiler->compileString( '@import "z.scss";' )->getCss();
	file_put_contents( __DIR__ . '/assets/css/combine.min.css', $cssOut );
}

function the_template_url() {
	echo TEMPLATE_URL;
}

if ( ! is_admin() ) {
	add_action( 'init', 'init_scripts', 10 );
}
/**
 * Deregister unnecessary scripts.
 */
function init_scripts() {
	wp_deregister_script( 'wp-embed' );
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'comment-reply' );
}

add_action( 'wp_enqueue_scripts', 'add_scripts', 10 );
/**
 * Enqueue scripts and styles.
 */
function add_scripts() {
	$js_path = ASSET_URL . 'js';
	$css_path = ASSET_URL . 'css';

	$js_libs = [ 
		[ 'jquery', $js_path . '/jquery.js', null, null, false ],
		[ 'bootstrap', $js_path . '/bootstrap.js', [ 'jquery' ], null, true ],
    [ 'swiper', $js_path . '/swiper.js', [ 'jquery' ], null, true ],
    [ 'stellarnav', $js_path . '/stellarnav.js', [ 'jquery' ], null, true ],
		[ 'script', $js_path . '/script.js', [ 'jquery' ], ASSET_VERSION, true ],
	];

	$css_libs = [ 
    [ 'bootstrap', $css_path . '/bootstrap.css', [], null, 'screen' ],
    [ 'swiper', $css_path . '/swiper.css', [], null, 'screen' ],
    [ 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css', [], '7.0.1', 'all' ],
    [
    'montserrat-font',
    'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap',
    [],
    null,
    'all'],

    [
    'open-sans-font',
    'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap',
    [],
    null,
    'all'
    ],   
    [ 'stellarnav', $css_path . '/stellarnav.css', [], null, 'screen' ],
    [ 'style', TEMPLATE_URL . '/style.css', [], ASSET_VERSION, 'all' ],
  ];


	foreach ( $js_libs as $lib ) {
		wp_enqueue_script( $lib[0], $lib[1], $lib[2], $lib[3], $lib[4] );
	}

	foreach ( $css_libs as $lib ) {
		wp_enqueue_style( $lib[0], $lib[1], $lib[2], $lib[3], $lib[4] );
	}

	wp_localize_script( 'script', 'siteSettings', [ 
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'site_nonce' ),
	] );
}

/**
 * Add theme support.
 */
function mytheme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'page', 'excerpt' );

	register_nav_menus( [ 
		'main' => 'Main',
    'footer_menu_1' => 'Footer Menu 1',
    'footer_menu_2' => 'Footer Menu 2',
    'footer_menu_3' => 'Footer Menu 3',
		'helpful' => 'Helpful Info',
		'privacy' => 'Privacy Info',
	] );
}

add_action( 'after_setup_theme', 'mytheme_setup' );

/**
 * Register sidebars.
 */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
			'name' => __( 'Main - Sidebar' ),
			'id' => 'main-sidebar-widget-area',
			'description' => 'Widgets in this area will be shown on the right sidebar of default page',
			'before_widget' => '<aside class="widget">',
			'after_widget' => '</aside>',
			'before_title' => '',
			'after_title' => '',
		)
	);
}

/**
 * Custom comment formatting.
 */
function theme_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
<li>
    <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <header class="comment-author vcard">
            <?php echo get_avatar( $comment, $size = '48', $default = '<path_to_url>' ); ?>
            <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
            <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                    <?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?>
                </a></time>
            <?php edit_comment_link( __( '(Edit)' ), '  ', '' ) ?>
        </header>
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em>
            <?php _e( 'Your comment is awaiting moderation.' ) ?>
        </em>
        <br />
        <?php endif; ?>

        <?php comment_text() ?>

        <nav>
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
        </nav>
    </article>
    <!-- </li> is added by wordpress automatically -->
    <?php
}

/*
|--------------------------------------
|   Map_via_acf
|--------------------------------------
*/
function my_acf_init() {
	if ( function_exists( 'acf_update_setting' ) ) {
		acf_update_setting( 'google_api_key', 'AIzaSyC44n4EJxputPRoWzorOaszqW-dFoVN8UE' );
	}
}

add_action( 'acf/init', 'my_acf_init' );

/**
 * Generate contact information links.
 */
function contact_description( $input_info = null, $attribute_name = null ) {
	$explode_info = explode( ',', $input_info );
	$output = '';

	foreach ( $explode_info as $index => $info ) {
		$output .= sprintf(
			'<a href="%s:%s"><span>%s</span></a>',
			esc_attr( $attribute_name ),
			esc_attr( trim( $info ) ),
			esc_html( trim( $info ) )
		);

		if ( $index < count( $explode_info ) - 1 ) {
			$output .= ', ';
		}
	}

	echo $output;
}

add_filter('block_categories_all', function( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'signature-travel-blocks',
                'title' => __( 'Signature Travel Blocks', 'textdomain' ),
                'icon'  => 'layout', 
            ],
        ]
    );
}, 10, 2);

add_action('acf/init', function() {
    if( function_exists('acf_register_block_type') ) {
      acf_register_block_type(array(
          'name'              => 'slider',
          'title'             => __('Slider'),
          'render_template'   => '/template-parts/blocks/slider.php',
          'category'          => 'signature-travel-blocks',
          'icon'              => 'slides',
      ));
      
      acf_register_block_type(array(
          'name'            => 'section-title',
          'title'           => __('Section Title'),
          'render_template' => '/template-parts/blocks/title.php',
          'category'        => 'signature-travel-blocks',
          'icon'            => 'admin-customizer', 
      ));
      
      acf_register_block_type(array(
          'name'            => 'button',
          'title'           => __('Button'),
          'render_template' => '/template-parts/blocks/button.php',
          'category'        => 'signature-travel-blocks',
          'icon'            => 'button', 
      ));
      
      acf_register_block_type(array(
          'name'            => 'overlay-bg-image',
          'title'           => __('Overlay BG Image'),
          'render_template' => '/template-parts/blocks/overlay-bg-image.php',
          'category'        => 'signature-travel-blocks',
          'icon'            => 'format-image',
      ));  
      
      acf_register_block_type(array(
          'name'            => 'image-card',
          'title'           => __('Image Card'),
          'render_template' => '/template-parts/blocks/image-card-block.php',
          'category'        => 'signature-travel-blocks',
          'icon'            => 'format-image',
      ));
      
      acf_register_block_type(array(
        'name' => 'tour-card',
        'title' => __('Tour Card'),
        'render_template' => '/template-parts/blocks/tour-card.php',
        'category' => 'signature-travel-blocks',
        'icon' => 'format-gallery',
      ));

      acf_register_block_type(array(
        'name' => 'social-links',
        'title' => __('Social Links'),
        'render_template' => '/template-parts/blocks/social-links.php',
        'category' => 'signature-travel-blocks',
        'icon' => 'admin-links',
      ));
    }
});

/**
 * Shortcode
 * 
 */
// function load_template_shortcode($atts, $template) {
//     ob_start();
//     get_template_part($template);
//     return ob_get_clean();
// }

// function destination_shortcode_function($atts = []) {
//     return load_template_shortcode($atts, 'template-parts/section/destination-section');
// }
// add_shortcode('destination_shortcode', 'destination_shortcode_function');

// function tripinspiration_shortcode_function($atts = []) {
//     return load_template_shortcode($atts, 'template-parts/section/trip-inspiration-section');
// }
// add_shortcode('tripinspiration_shortcode', 'tripinspiration_shortcode_function');

// function signature_travel_shortcode_function($atts = []) {
//     return load_template_shortcode($atts, 'template-parts/section/signature-travel-section');
// }
// add_shortcode('signature_travel_shortcode', 'signature_travel_shortcode_function');

// function travelwithus_shortcode_function($atts = []) {
//     return load_template_shortcode($atts, 'template-parts/section/travelwithus-section');
// }
// add_shortcode('travelwithus_shortcode', 'travelwithus_shortcode_function');

// function travel_longue_shortcode_function($atts = []) {
//     return load_template_shortcode($atts, 'template-parts/section/travel-longues-section');
// }
// add_shortcode('travellongue_shortcode', 'travel_longue_shortcode_function');