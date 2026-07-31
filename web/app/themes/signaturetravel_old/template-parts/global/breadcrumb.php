<?php
$default_image = ASSET_URL . 'images/inner-banner.jpg';
$hide_banner_image = is_tax('destination');

if ( is_tax() || is_category() || is_tag() ) {

    $term = get_queried_object();

    $banner_image = get_field(
        'banner_image',
        $term->taxonomy . '_' . $term->term_id
    );

} else {

    $banner_image = get_field('banner_image', get_the_ID());

}
$image_url = !empty($banner_image) ? $banner_image : $default_image;
?>

<section class="inner-banner">
    <div class="inner-banner__hero">
        <?php if ( !$hide_banner_image ) : ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="">
        <?php endif; ?>
        
        <div class="inner-banner__overlay">
            <div class="container">
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                }
                ?>
            </div>
        </div>
    </div>
</section>