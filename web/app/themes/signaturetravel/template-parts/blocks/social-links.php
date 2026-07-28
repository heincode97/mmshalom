<?php
$post_url   = urlencode(get_permalink());
$post_title = urlencode(get_the_title());
?>

<section class="social-links-section mt-5">
		<div class="container">
			<div class="section-heading">
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
										<a href="<?php echo esc_url( $link_url ) . $post_url . "&t=".$post_title; ?>" target="_blank" rel="noopener noreferrer" class="d-inline-flex align-items-center justify-content-center rounded-circle">
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