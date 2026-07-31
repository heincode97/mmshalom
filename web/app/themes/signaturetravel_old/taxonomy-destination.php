<?php get_header(); ?>
<?php
$term = get_queried_object();
if ($term && !is_wp_error($term)) {
    $slider = get_field('slider', 'destination_' . $term->term_id);
}
?>
<?php if ($slider): ?>
    <section class="slider-section">
        <div class="swiper bannerSwiper">
            <div class="swiper-wrapper">
                <?php foreach ($slider as $sli):
                    $image = $sli['image'] ?? [];
                    $title = $sli['title'] ?? '';
                    $link = $sli['button'] ?? [];
                    ?>
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <img src="<?php echo esc_url($image['url'] ?? ''); ?>" class="img-fluid kenburns"
                                alt="<?php echo esc_attr($image['title'] ?? ''); ?>">
                            <div class="overlay"></div>
                            <div class="text-wrapper">
                                <h1 class="text-white mb-4"><?php echo esc_html($title); ?></h1>
                                <?php if (!empty($link['url'])): ?>
                                    <a href="<?php echo esc_url($link['url']); ?>"
                                        class="btn btn-primary"><?php echo esc_html($link['title']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination swiper-pagination-banner"></div>
        </div>
    </section>

<?php endif; ?>
<section class="tour-destination gap-y">
    <div class="container">
        <div class="cta-buttons">
            <a href="<?php echo esc_url( home_url( '/destinations/' ) ); ?>" class="cta-btn active">Destination</a>
            <a href="#itinerary" class="cta-btn">Itinerary</a>
            <a href="<?php echo esc_url( home_url( '/experience/' . $term->slug ) ); ?>" class="cta-btn">Experience</a>
        </div>
        <div class="section-heading pt-5">
            <h2 class="main-title text-center">
                <?php echo esc_html(strtoupper($term->name)); ?></h2>
            <?php if ($term->description): ?>
                <div class="destination-description"><?php echo wp_kses_post(wpautop($term->description)); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="tour-destination gap-y section-bg">
    <div class="container">
        <div class="section-heading">
            <h2 class="main-title text-center">
                <?php echo strtoupper('Destination in') . ' ' . esc_html(strtoupper($term->name)); ?></h2>
        </div>
        <?php

        $tour_query = new WP_Query([
            'post_type' => 'tour-package',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => 'destination',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ],
            ],
        ]);
        ?>
        <div class="destination-list destination-list pt-4">
            <?php if ($tour_query->have_posts()): ?>
                <?php $card_index = 0;
                while ($tour_query->have_posts()):
                    $tour_query->the_post(); ?>
                    <?php
                    $title = get_the_title();
                    $second_feature = get_field('feature_image');
                    $thumb_url = is_array($second_feature) ? ($second_feature['url'] ?? '') : $second_feature;
                    if (empty($thumb_url)) {
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    }
                    $is_even = ($card_index % 2 === 0);
                    $card_index++;
                    ?>
                    <article class="destination-item destination-item">
                        <div class="destination-image destination-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (!empty($thumb_url)) { ?>
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="destination-content destination-content<?php echo $is_even ? '' : ' reverse'; ?>">
                            <h4 class="main-title text-start destination-title">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a>
                            </h4>
                            <?php $excerpt = get_the_excerpt();
                            if (!empty($excerpt)) { ?>
                                <div class="destination-desc destination-excerpt">
                                    <p><?php echo esc_html($excerpt); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p>No tour packages found for this destination.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>