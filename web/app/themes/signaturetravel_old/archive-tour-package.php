<?php
get_header();
?>

<section class="tour-experience gap-y">
    <div class="container container-sm">

        <div class="section-heading">
            <h2 class="main-title text-center">
                EXPLORE SIGNATURE EXPERIENCES
            </h2>
            <p class="text-center">
                It is our experiences that stay with us no matter where we travel. With this in mind, our team has carefully curated a wildly diverse experience collection in each country.  And if you don’t find exactly what you’re looking for, simply let us know — our extensive network of local connections can unlock opportunities far beyond the ordinary.
            </p>
        </div>

    </div>
</section>

<section class="tour-experience gap-y section-bg">
    <div class="container">
        <?php
        $destinations = get_terms([
            'taxonomy'   => 'destination',
            'hide_empty' => true,
        ]);
        ?>

        <div class="experience-tabs">
            <a href="<?php echo get_post_type_archive_link('tour-package'); ?>"
               class="tab-btn active">
                All
            </a>
            <?php foreach ($destinations as $destination) : ?>
                <a href="<?php echo esc_url(get_term_link($destination)); ?>"
                   class="tab-btn">
                    <?php echo esc_html(strtoupper($destination->name)); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="row">
          <?php
          $tours = new WP_Query([
              'post_type'      => 'tour-package',
              'post_status'    => 'publish',
              'posts_per_page' => 36,
//               'orderby'        => 'date',
//               'order'          => 'ASC',
          ]);
          if ( $tours->have_posts() ) :
              while ( $tours->have_posts() ) : $tours->the_post();
                  $title = get_field('title');
                  $second_feature = get_field('second_feature_image');
          
//                   if ( is_array( $second_feature ) ) {
//                       $thumb = $second_feature['url'] ?? '';
//                   } else {
//                       $thumb = $second_feature;
//                   }
//                   if ( empty( $thumb ) ) {
//                       $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
//                   }
//            test
               $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if ( ! $thumb ) {
                    $second_feature = get_field( 'second_feature_image' );
                    $thumb = is_array( $second_feature )
                        ? ( $second_feature['url'] ?? '' )
                        : $second_feature;
                }
            ?>
              <div class="col-lg-3 col-md-6 col-12">
                  <?php
                  set_query_var(
                      'post_data',
                      [
                          'id'            => get_the_ID(),
                          'title'         => ! empty( $title ) ? $title : get_the_title(),
                          'thumb'         => $thumb,
                          'link'          => get_permalink(),
                          'summary'       => '',
                          'card_template' => 'hover_outline_card',
                      ]
                  );

                  get_template_part( 'partials/image', 'card' );
                  ?>
              </div>
          <?php
              endwhile;
              wp_reset_postdata();
          else :
          ?>
              <div class="col-12">
                  <p>No tour packages found.</p>
              </div>
          <?php endif; ?>
          </div>
     
    </div>

</section>
<section class="tour-experience gap-y">
    <div class="container container-sm">
      <div class="section-heading">
            <h2 class="main-title text-center">
                Special Interests Tour
            </h2>
           <p class="text-center">
          We are constantly breaking new ground to develop innovative and interesting new tours. So whether your passion is Wildlife Experiences, Bird Watching, Gemology Tours, Art Tours, Diving Tours, Business Retreats, or something entirely different, ABC Travel has itineraries and ideas designed with you in mind.
          </p>

          <p class="pt-2 text-center">
          With experts in each individual field and staff with years of experience, we possess the resources and insight to make your holiday uniquely special. If you do not see what you desire, get inspired by our ideas and send us your request; we will customize a tour to meet your specific needs.
          </p>
        </div>
      </div>
    <div class="container">
      <div class="row pt-4">
            <?php
            $special_tours = new WP_Query([
                'post_type'      => 'tour-package',
                'post_status'    => 'publish',
                'posts_per_page' => 8,
                'tax_query'      => [
                    [
                        'taxonomy' => 'destination',
                        'field'    => 'slug',
                        'terms'    => 'special-interest-tour',
                    ]
                ]
            ]);

            if ( $special_tours->have_posts() ) :
                while ( $special_tours->have_posts() ) : $special_tours->the_post();

                    $title = get_field('title');

                    $thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );

                    if ( ! $thumb ) {
                        $second_feature = get_field('second_feature_image');
                        $thumb = is_array($second_feature)
                            ? ($second_feature['url'] ?? '')
                            : $second_feature;
                    }
            ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <?php
                    set_query_var(
                        'post_data',
                        [
                            'id'            => get_the_ID(),
                            'title'         => ! empty( $title ) ? $title : get_the_title(),
                            'thumb'         => $thumb,
                            'link'          => get_permalink(),
                            'summary'       => '',
                            'card_template' => 'hover_outline_card',
                        ]
                    );

                    get_template_part( 'partials/image', 'card' );
                    ?>
                </div>

            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
</div>
        

        

    
</section>

<?php get_footer(); ?>