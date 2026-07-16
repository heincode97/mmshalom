<?php 
  // ----------------------
  // Global Options
  // ----------------------
  $general = get_field('general_setting', 'option');
  $phone   = $general['contact_number'] ?? '';

  $social_medias = get_field('social_media_links', 'option');
  $facebook  = $social_medias['facebook'] ?? '';
  $twitter   = $social_medias['twitter'] ?? '';
  $linkedin  = $social_medias['linkedin'] ?? '';
  $instagram = $social_medias['instagram'] ?? '';
  $youtube   = $social_medias['youtube'] ?? '';
  $trip_adv  = $social_medias['trip_advisor'] ?? '';
?>

<footer>
  <div class="gap-y">
    <?php 
      $fm1_name = wp_get_nav_menu_object(ST_FOOTER_MENU_1)->name ?? '';
      $fm2_name = wp_get_nav_menu_object(ST_FOOTER_MENU_2)->name ?? '';
    ?>
    <div class="container">
      <div class="row">

        <!-- Footer Menu 1 -->
        <div class="col-lg-3 col-md-6 col-12">
          <?php if ($fm1_name): ?>
            <h5><?php echo esc_html($fm1_name); ?></h5>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'footer_menu_1']); ?>
        </div>

        <!-- Footer Menu 2 -->
        <div class="offset-lg-1 col-lg-2 col-md-6 col-12">
          <?php if ($fm2_name): ?>
            <h5><?php echo esc_html($fm2_name); ?></h5>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'footer_menu_2']); ?>
        </div>

        <!-- Destination Taxonomy -->
        <div class="offset-lg-1 col-lg-2 col-md-6 col-12">
          <?php
            $taxonomy = get_taxonomy('destination');
            $des_name = $taxonomy->labels->name ?? 'Destinations';
            $destinations = get_terms([
              'taxonomy'   => ST_DESTI_TAXO, 
              'hide_empty' => false,
            ]);
          ?>

          <h5><?php echo esc_html($des_name); ?></h5>

          <?php if (!empty($destinations) && !is_wp_error($destinations)): ?>
            <ul class="footer-destination-list">
              <?php foreach ($destinations as $destination): ?>
                <?php 
                  $name = $destination->name;
                  $link = get_term_link($destination->term_id);
                ?>
                <li>
                  <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($name); ?>">
                    <?php echo esc_html($name); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

        <!-- Social Media -->
        <div class="offset-lg-1 col-lg-2 col-md-6 col-12 social-media">
          <h5>Stay in Touch</h5>
          <div class="d-lg-block d-flex gap-lg-0 gap-2">
            
            <!-- Row 1 -->
            <div class="d-flex gap-2 mb-2">
              <?php if ($facebook): ?>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" aria-label="Facebook">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/facebook.svg" class="img-fluid" alt="Facebook">
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($twitter): ?>
                <a href="<?php echo esc_url($twitter); ?>" target="_blank" aria-label="Twitter">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/twitter.svg" class="img-fluid" alt="Twitter">
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($linkedin): ?>
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" aria-label="LinkedIn">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/linked-in.svg" class="img-fluid" alt="LinkedIn">
                  </div>
                </a>
              <?php endif; ?>
            </div>

            <!-- Row 2 -->
            <div class="d-flex gap-2">
              <?php if ($instagram): ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" aria-label="Instagram">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/instagram.svg" class="img-fluid" alt="Instagram">
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($youtube): ?>
                <a href="<?php echo esc_url($youtube); ?>" target="_blank" aria-label="YouTube">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/youtube.svg" class="img-fluid" alt="YouTube">
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($trip_adv): ?>
                <a href="<?php echo esc_url($trip_adv); ?>" target="_blank" aria-label="TripAdvisor">
                  <div class="s-icon">
                    <img src="<?php echo ASSET_URL; ?>images/trip-advisor.svg" class="img-fluid" alt="TripAdvisor">
                  </div>
                </a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom secondary-bg">
    <div class="container">
      <div class="row align-items-center">
        
        <div class="col-lg-6 col-12 text-lg-start text-center mb-lg-0 mb-3">
          <?php wp_nav_menu(['theme_location' => 'footer_menu_3']); ?>
        </div>

        <div class="col-lg-6 col-12 text-lg-end text-center">
          <p>© <?php echo esc_html(date('Y')); ?> Signature Travel. All Rights Reserved.</p>
        </div>

      </div>
    </div>
  </div>
<!--   <div class="scrollTop"><img src="<?php //echo TEMPLATE_URL; ?>/assets/images/arrow-up.png" alt=""></div> -->
  <a id="scrollTop"></a>
</footer>

<?php wp_footer(); ?>
</body>
</html>
