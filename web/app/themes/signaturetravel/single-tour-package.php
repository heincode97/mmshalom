<?php
/**
 * Single Tour Package template
 */

get_header();

$banner = get_field('banner_image');
$banner_url = '';
if ( is_array( $banner ) && isset( $banner['url'] ) ) {
	$banner_url = $banner['url'];
} elseif ( is_string( $banner ) ) {
	$banner_url = $banner;
}

$summary_heading = get_field('summary_heading') ?: get_the_title();
$summary_description = get_field('summary_description');
?>

<main id="site-content" role="main">

	<section class="tour-experience gap-y">
		<div class="container container-sm">
			<div class="section-heading">
				<h2 class="main-title text-center"><?php echo esc_html( $summary_heading ); ?></h2>
				<?php if ( ! empty( $summary_description ) ) : ?>
					<p class="text-center"><?php echo wp_kses_post( $summary_description ); ?></p>
				<?php endif; ?>
				<div class="social text-center">
					<p>Share this article from Signature Travel</p>
					<?php if(have_rows('social_link')): ?>
						<ul class="social-links d-flex justify-content-center list-unstyled gap-3">
							<?php while(have_rows('social_link')): the_row();
								$social_link = get_sub_field('url');
								$social_icon = get_sub_field('icon');
								if($social_link && $social_icon):
									$link_url = is_array( $social_link ) && isset( $social_link['url'] ) ? $social_link['url'] : $social_link;
									?>
									<li>
										<a href="<?php echo esc_url( $link_url ); ?>" target="_blank" rel="noopener noreferrer" class="d-inline-flex align-items-center justify-content-center rounded-circle">
											<img src="<?php echo esc_url( $social_icon['url'] ); ?>" alt="<?php echo esc_attr( $social_icon['alt'] ); ?>" />
										</a>
									</li>
								<?php endif; ?>
							<?php endwhile; ?>
						</ul>
					<?php else: ?>
						<p>No social links available.</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="tour-experience gap-y section-bg">
		<div class="container">

			<div class="experience-list">
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
						<article class="experience-item">
							<div class="experience-image">
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
							<div class="experience-content <?php echo $is_image_left ? '' : 'reverse'; ?>">
								<h4 class="main-title text-start"><?php echo esc_html( $card_title ); ?></h4>
								<div class="experience-desc">
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

	<section class="tour-experience gap-y">
		<div class="container container-sm">
			<div class="section-heading">
				<?php if(!empty(get_field('title'))): ?>
				<h2 class="main-title text-center"><?php echo esc_html(get_field('title')); ?></h2>
				<?php endif; ?>
				<?php if(!empty(get_field('description'))): ?>
					<p class="text-center"><?php echo esc_html(get_field('description')); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="tour-experience gap-y">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</section>
</main>

<?php
get_footer();
