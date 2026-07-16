
<?php
$post_data = get_query_var( 'post_data' );
if ( ! empty( $post_data['card_template'] ) ) {
	$card_template = $post_data['card_template'];
} else {
	$fields = get_fields();
	$card_template = $fields['card_template'] ?? '';
}

// $fields        = get_fields();
// $card_template = $fields['card_template'] ?? '';
if ( $card_template == 'hover_overlay_card' ) {
	$card_layout  = 'desti-card mb-0';
	$img_class    = '';
	$effect_class = '';
	$display      = 'd-none';
	$zoom_class   = '';
	$mt           = 'mt-0';
	$mb           = 'mb-3';
	$alt          = '';

} elseif ( $card_template == 'hover_outline_card' ) {
	$card_layout  = 'signature-card mb-4';
	$img_class    = 'img-card';
	$effect_class = 'zoom-overlay overlay-img position-relative';
	$display      = 'd-none';
	$text_color   = 'text-white';
	$zoom_class   = '';
	$mt           = 'mt-0';
	$mb           = 'mb-0';
	$alt          = '';
	//   $text_align = 'text-center';

} elseif ( $card_template == 'green_card' ) {
	$card_layout  = 'green-card mb-0';
	$img_class    = '';
	$effect_class = '';
	$display      = 'd-none';
	$zoom_class   = '';
	$mt           = 'mt-0';
	$mb           = 'mb-3';
	$alt          = '';
	$text_align   = 'text-start';
	$text_color   = 'text-white';

} elseif ( $card_template == 'outline_card' ) {
	$card_layout  = 'longue-card mb-0';
	$img_class    = '';
	$effect_class = '';
	$display      = 'd-block';
	$text_color   = 'text-white';
	$zoom_class   = 'zoom-overlay';
	$mt           = 'mt-3';
	$mb           = 'mb-3';
	$alt          = 'alt';

} else {
	$card_layout  = 'trip-card mb-4';
	$img_class    = '';
	$effect_class = '';
	$display      = 'd-block';
	$text_color   = 'text-dark';
	$zoom_class   = '';
	$mt           = 'mt-0';
	$mb           = 'mb-3';
	$alt          = '';
}
$post_data = get_query_var( 'post_data' );

$id        = $post_data['id'] ?? 0;
$title     = $post_data['title'] ?? '';
$thumb     = $post_data['thumb'] ?? '';
$link      = $post_data['link'] ?? '#';
$summary   = $post_data['summary'] ?? '';
$image_url = ! empty( $thumb )
	? esc_url( $thumb )
	: esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' );
?>

<div class="<?php echo $card_layout; ?> text-center card-wrapper d-none">

	<div class="<?php echo $img_class; ?> card-top">
		<div class="<?php echo $effect_class; ?>">
			<div class="aa">
				<a href="<?php echo esc_url( $link ); ?>" class="d-block">
					<div class="<?php echo $zoom_class; ?> mb-3">
						<img src="<?php echo $image_url; ?>" class="img-fluid"
							alt="<?php echo esc_attr( $title ?: 'Trip Image' ); ?>">
					</div>
				</a>

				<?php if ( ! empty( $title ) ) : ?>
					<a href="<?php echo $link; ?>">
						<h5 class="<?php echo $mb . ' ' . $text_color . ' ' . $text_align; ?>">
							<?php echo esc_html( $title ); ?>
						</h5>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="link card-bottom">
		<div class="<?php echo $display; ?>">
			<a href="<?php echo esc_url( $link ); ?>" class="btn btn-secondary <?php echo $alt; ?>">
				<?php echo ( $card_template == 'outline_card' ) ? 'Read More' : 'View Details'; ?>
			</a>
		</div>

		<?php if ( ! empty( $summary ) ) : ?>
			<p class="text-white mb-0 <?php echo $text_align; ?>">
				<?php echo esc_html( $summary ); ?>
			</p>
		<?php endif; ?>
	</div>

</div>






<div class="<?php echo $card_layout; ?> text-center">
	<div class="<?php echo $img_class; ?>">
		<div class="<?php echo $effect_class; ?>">
			<a href="<?php echo esc_url( $link ); ?>" class="d-block">
				<div class="<?php echo $zoom_class; ?>">
					<img src="<?php echo $image_url; ?>" class="img-fluid" alt="<?php echo esc_attr( $title ?: 'Trip Image' ); ?>">
				</div>
			</a>
			<div class="text-wrapper <?php echo $mt; ?>">
				<?php if ( ! empty( $title ) ) : ?>
					<a href="<?php echo $link; ?>">
						<h5 class="<?php echo $mb . ' ' . $text_color . ' ' . $text_align; ?>"><?php echo esc_html( $title ); ?></h5>
					</a>
				<?php endif; ?>
				<div class="<?php echo $display; ?>">
					<a href="<?php echo esc_url( $link ); ?>" class="btn btn-secondary <?php echo $alt; ?>">
						<?php echo ( $card_template == 'outline_card' ) ? 'Read More' : 'View Details'; ?>
					</a>
				</div>

				<?php if ( ! empty( $summary ) ) : ?>
					<p class="text-white mb-0 <?php echo $text_align; ?>">
						<?php echo esc_html( $summary ); ?>
					</p>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>