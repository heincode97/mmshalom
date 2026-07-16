<?php
$fields            = get_fields();
$choose_type       = $fields['choose_type'] ?? '';
$destination       = $fields['destinations'] ?? '';
$tour_package_taxo = $fields['tour_package_taxo'] ?? '';
$layout            = $fields['layout'] ?? '';

$post_count = $fields['post_count'];

if ( $choose_type == 'destination' && $layout == 'slider' ) {
	$taxo_name    = $choose_type;
	$destinations = get_terms( [
		'taxonomy'   => $taxo_name,
		'hide_empty' => false,
	] );
	?>
	<section class="destinations">
		<div class="container-fluid">
			<div class="swiper destiSwiper">
				<div class="swiper-wrapper">
					<?php foreach ( $destinations as $desi ) :
						$thumbnail = get_field( 'destination_image', $taxo_name . '_' . $desi->term_id );
						$thumb_url = is_array( $thumbnail ) && isset( $thumbnail['url'] )
							? $thumbnail['url']
							: ( is_string( $thumbnail ) ? $thumbnail : '' );
						$title     = $desi->name ?? '';
						$link      = get_term_link( $desi->term_id );
						?>
						<div class="swiper-slide">
							<div class="desti-card">
								<a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title ); ?>">
									<?php if ( ! empty( $thumb_url ) ) : ?>
										<div class="zoom-overlay img-wrapper">
											<img src="<?php echo esc_url( $thumb_url ); ?>" class="img-fluid" alt="<?php echo esc_attr( $title ); ?>">
										</div>
									<?php endif; ?>
									<div class="text-wrapper">
										<?php if ( ! empty( $title ) ) : ?>
											<h4 class="text-white"><?php echo esc_html( $title ); ?> <img
													src="<?php echo ASSET_URL; ?>images/arrow-right.svg" class="img-fluid" alt="arrow"></h4>
										<?php endif; ?>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-next swiper-button-next-desti"></div>
				<div class="swiper-button-prev swiper-button-prev-desti"></div>
			</div>
		</div>
	</section>
<?php } elseif ( $choose_type == 'tour-package' && $tour_package_taxo->slug == 'travel-logues' ) { ?>
	<?php
	$taxonomy  = ST_TOUR_TYPE;
	$term_slug = 'travel-logues';
	$layout = get_field( 'layout' );

	$args = array(
		'post_type'      => ST_TOUR_PT,
		'posts_per_page' => $post_count,
		'tax_query'      => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_slug,
			),
		),
	);

	$query = new WP_Query( $args );
	?>

	<?php if ( $query->have_posts() ) : ?>
		<?php if ( $layout == 'slider' ) { ?>
		<div class="position-relative travellongue">
			<div class="swiper travelLongueSwiper">
				<div class="swiper-wrapper">
					<?php while ( $query->have_posts() ) :
						$query->the_post(); ?>
						<?php
						$post_data = [
							'id'    => get_the_ID(),
							'title' => get_the_title(),
							'thumb' => get_the_post_thumbnail_url( get_the_ID() ),
							'link'  => get_permalink(),
						];
						?>
						<div class="swiper-slide">
							<?php
							set_query_var( 'post_data', $post_data );
							get_template_part( 'partials/image', 'card' );
							?>

							<?php if ( ! empty( $title ) ) : ?>
								<div class="longue-card text-center d-none">
									<div class="zoom-overlay">
										<a href="<?php echo esc_url( $link ?? '#' ); ?>" title="<?php echo esc_attr( $title ?? '' ); ?>">
											<img
												src="<?php echo esc_url( ! empty( $image ) ? $image : get_template_directory_uri() . '/assets/images/placeholder.jpg' ); ?>"
												class="img-fluid" alt="<?php echo esc_attr( $title ?? 'Image' ); ?>">
										</a>
									</div>

									<div class="text-wrapper mt-3">
										<?php if ( ! empty( $title ) ) : ?>
											<h5 class="text-white mb-3"><?php echo esc_html( $title ); ?></h5>
										<?php endif; ?>

										<a href="<?php echo esc_url( $link ?? '#' ); ?>" class="btn btn-secondary alt">
											Read More
										</a>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="swiper-pagination swiper-pagination-tl"></div>

			<div class="swiper-button-next swiper-button-next-tl"></div>
			<div class="swiper-button-prev swiper-button-prev-tl"></div>
		</div>
		<?php } elseif ( $layout == 'grid' ) { ?>
			<div class="row">
				<?php while ( $query->have_posts() ) :
					$query->the_post(); ?>
					<?php
					$post_data = [
						'id'    => get_the_ID(),
						'title' => get_the_title(),
						'thumb' => get_the_post_thumbnail_url( get_the_ID() ),
						'link'  => get_permalink(),
					];
					?>
					<div class="col-md-4 mb-4">
						<?php
						set_query_var( 'post_data', $post_data );
						get_template_part( 'partials/image', 'card' );
						?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
<?php } elseif ( $choose_type == 'tour-package' ) { ?>

	<?php if ( $tour_package_taxo->slug == 'trip-inspiration' ) {
		$taxo_name = is_object( $tour_package_taxo ) ? $tour_package_taxo->slug : $tour_package_taxo;
		$col       = 'col-lg-4 col-md-6 col-12';
	} elseif ( $tour_package_taxo->slug == 'signature-travel-experiences' ) {
		$taxo_name = is_object( $tour_package_taxo ) ? $tour_package_taxo->slug : $tour_package_taxo;
		$col       = 'col-lg-3 col-md-6 col-12';
	}
	//   elseif($tour_package_taxo->slug == 'travel-logues') {
//     $taxo_name = is_object($tour_package_taxo) ? $tour_package_taxo->slug : $tour_package_taxo;
//   }
	$taxonomy = ST_TOUR_TYPE;
	$args     = [
		'post_type'      => ST_TOUR_PT,
		'posts_per_page' => $post_count,
		'orderby'        => 'date', // or menu_order, title, rand...
		'order'          => 'ASC',
		'tax_query'      => [
			[
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $taxo_name,
			],
		],
	];

	$query = new WP_Query( $args );
	?>
	<div class="row">
		<?php if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$post_data = [
					'id'    => get_the_ID(),
					'title' => get_the_title(),
					'thumb' => get_the_post_thumbnail_url( get_the_ID() ),
					'link'  => get_permalink(),
				];
				?>
				<div class="<?php echo $col; ?>">
					<?php
					set_query_var( 'post_data', $post_data );
					get_template_part( 'partials/image', 'card' );
					?>
				</div>
			<?php
			endwhile;
			wp_reset_postdata();
		endif; ?>
	</div>
<?php } elseif ( $choose_type == 'blog' ) {
	$layout = get_field( 'layout' );
	?>
	<?php
	$blogs = get_posts( array(
		'post_type'      => ST_BLOG_PT,
		'post_status'    => 'publish',
		'posts_per_page' => $post_count,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );

	if ( $blogs ) : ?>
		<?php if ( $layout == 'slider' ) { ?>
			<div class="position-relative">
				<div class="swiper wtSwiper">
					<div class="swiper-wrapper">
						<?php foreach ( $blogs as $blog ) :
							$post_data = array(
								'title'   => $blog->post_title,
								'thumb'   => get_the_post_thumbnail_url( $blog->ID ),
								'link'    => get_the_permalink( $blog->ID ),
								'summary' => $blog->post_excerpt,
							);
							?>
							<div class="swiper-slide">
								<?php
								set_query_var( 'post_data', $post_data );
								get_template_part( 'partials/image', 'card' );
								?>
							</div>
						<?php
						endforeach; ?>
					</div>
				</div>
				<div class="swiper-button-next swiper-button-next-wt"></div>
				<div class="swiper-button-prev swiper-button-prev-wt"></div>
			</div>
		<?php } elseif ( $layout == 'grid' ) { ?>
			<div class="row">
				<?php foreach ( $blogs as $blog ) :
					$post_data = array(
						'title'   => $blog->post_title,
						'thumb'   => get_the_post_thumbnail_url( $blog->ID ),
						'link'    => get_the_permalink( $blog->ID ),
						'summary' => $blog->post_excerpt,
					);
					?>
					<div class="col-md-4 mb-4">
						<?php
						set_query_var( 'post_data', $post_data );
						get_template_part( 'partials/image', 'card' );
						?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p class="text-center">No blog posts found.</p>
	<?php endif; ?>
<?php } ?>