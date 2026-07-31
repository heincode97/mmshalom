<?php
get_header();

$current_term = get_queried_object();
?>

<section class="tour-experience gap-y">
    <div class="container container-sm">
        <div class="section-heading">
            <h2 class="main-title text-center">
                <?php
                if (strtolower($current_term->slug) === 'special-interest-tour') {
                    echo esc_html(strtoupper($current_term->name));
                } else {
                    echo 'UNFORGETTABLE EXPERIENCES IN ' . esc_html(strtoupper($current_term->name));
                }
                ?>
            </h2>
            <?php if ($current_term->description): ?>
                <p class="text-center">
                    <?php echo wp_kses_post($current_term->description); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="tour-experience gap-y section-bg">
    <div class="container">
        <?php
        $destinations = get_terms([
            'taxonomy' => 'experience',
            'hide_empty' => true,
            //             'orderby'    => 'term_id',
            'orderby' => 'date',
            'order' => 'ASC'
        ]);
        ?>

        <div class="experience-tabs">
            <a href="<?php echo get_post_type_archive_link('tour-package'); ?>"
                class="tab-btn <?php echo is_post_type_archive('tour-package') ? 'active' : ''; ?>">
                All
            </a>
            <?php foreach ($destinations as $destination): ?>
                <a href="<?php echo esc_url(get_term_link($destination)); ?>"
                    class="tab-btn <?php echo (isset($current_term) && $current_term->term_id == $destination->term_id) ? 'active' : ''; ?>">
                    <?php echo esc_html(strtoupper($destination->name)); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="experience-list">
            <?php while (have_posts()):
                the_post(); ?>
                <?php
                $data = get_fields();
                $title = $data['title'];
                $second_feature = $data['second_feature_image'];
                ?>
                <article class="experience-item">
                    <div class="experience-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (!empty($second_feature)) { ?>
                                <img src="<?php echo esc_url($second_feature); ?>" alt="<?php echo esc_attr($title); ?>">
                            <?php } else { ?>
                                <?php the_post_thumbnail('large');
                            } ?>
                        </a>
                    </div>
                    <div class="experience-content">
                        <h4 class="main-title text-start">
                            <?php if (!empty($title)) { ?>
                                <?php echo esc_html($title); ?>

                            <?php } else {
                                the_title();
                            } ?>
                        </h4>
                        <div class="experience-desc">

                            <?php
                            if (has_excerpt()) {
                                the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 40);
                            }
                            ?>
                        </div>
                    </div>

                </article>

            <?php endwhile; ?>

        </div>

    </div>

</section>

<?php get_footer(); ?>