<section class="tour-destination gap-y section-bg">
    <div class="container">

        <div class="destination-list">
            <?php
            if ( have_rows( 'tour_card' ) ) :
                $i = 0;
                while ( have_rows( 'tour_card' ) ) : the_row();
                    $card_image = get_sub_field( 'tour_card_image' ) ?: get_sub_field( 'card_image' ) ?: get_sub_field( 'image' );
                    $card_title = get_sub_field( 'tour_card_heading' ) ?: get_sub_field( 'card_title' ) ?: get_sub_field( 'title' ) ?: '';
                    $card_text  = get_sub_field( 'tour_card_description' ) ?: get_sub_field( 'card_text' ) ?: get_sub_field( 'text' ) ?: get_sub_field( 'description' ) ?: '';
                    $card_link  = get_sub_field( 'card_link' ) ?: get_sub_field( 'link' );
                    $card_layout = get_sub_field( 'card_layout' );

                    $img_url = '';
                    if ( is_array( $card_image ) && isset( $card_image['url'] ) ) {
                        $img_url = $card_image['url'];
                    } elseif ( is_string( $card_image ) ) {
                        $img_url = $card_image;
                    }

                    $is_image_left = true;
                    if ( ! empty( $card_layout ) ) {
                        $is_image_left = ( $card_layout === 'image-left' );
                    } else {
                        $is_image_left = ( $i % 2 === 0 );
                    }
                    ?>
                    <article class="destination-item">
                        <div class="destination-image">
                            <?php if ( ! empty( $card_link ) ) :
                                $link_url = is_array( $card_link ) && isset( $card_link['url'] ) ? $card_link['url'] : $card_link;
                                $link_open = '<a href="' . esc_url( $link_url ) . '">';
                                $link_close = '</a>';
                            else :
                                $link_open = '';
                                $link_close = '';
                            endif;
                            ?>
                            <?php echo $link_open; ?>
                                <?php if ( ! empty( $img_url ) ) : ?>
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $card_title ); ?>" />
                                <?php endif; ?>
                            <?php echo $link_close; ?>
                        </div>
                        <div class="destination-content <?php echo $is_image_left ? '' : 'reverse'; ?>">
                            <h4 class="main-title text-start"><?php echo esc_html( $card_title ); ?></h4>
                            <div class="destination-desc">
                                <?php echo wp_kses_post( wpautop( $card_text ) ); ?>
                            </div>
                        </div>
                    </article>

                    <?php
                    $i++;
                endwhile;
            else :
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
            endif;
            ?>
        </div>

    </div>
</section>
