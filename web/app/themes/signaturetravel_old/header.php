<?php global $THEME_OPTIONS; ?>
<!doctype html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>
        <?php wp_title(''); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <?php if (file_exists(TEMPLATEPATH . '/favicon.png')): ?>
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.png">
    <?php endif; ?>
    <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    <?php wp_head(); ?>
</head>
<?php $body_classes = join(' ', get_body_class()); ?>

<body class="<?php if (!is_search())
    echo $body_classes; ?>">
  
  <?php 
  $general = get_field('general_setting', 'option');

  $phone = $general['contact_number'] ?? '';
  $logo  = $general['logo'] ?? ASSET_URL . 'images/logo.png';

  $social_medias = get_field('social_media_links', 'option');

  $facebook  = $social_medias['facebook'] ?? '';
  $linkedin  = $social_medias['linkedin'] ?? '';
  $instagram = $social_medias['instagram'] ?? '';
  $youtube   = $social_medias['youtube'] ?? '';
  $trip_adv  = $social_medias['trip_advisor'] ?? '';
?>

<header>
  <!-- Top Bar -->
  <section class="header-top primary-bg">
    <div class="container">
      <div class="row">
        <div class="col-12 text-end">

          <?php if ($facebook): ?>
            <a href="<?php echo esc_url($facebook); ?>" target="_blank">
              <img src="<?php echo ASSET_URL; ?>images/facebook.svg" class="img-fluid" alt="Facebook">
            </a>
          <?php endif; ?>

          <?php if ($linkedin): ?>
            <a href="<?php echo esc_url($linkedin); ?>" target="_blank">
              <img src="<?php echo ASSET_URL; ?>images/linked-in.svg" class="img-fluid" alt="LinkedIn">
            </a>
          <?php endif; ?>

          <?php if ($instagram): ?>
            <a href="<?php echo esc_url($instagram); ?>" target="_blank">
              <img src="<?php echo ASSET_URL; ?>images/instagram.svg" class="img-fluid" alt="Instagram">
            </a>
          <?php endif; ?>

          <?php if ($youtube): ?>
            <a href="<?php echo esc_url($youtube); ?>" target="_blank">
              <img src="<?php echo ASSET_URL; ?>images/youtube.svg" class="img-fluid" alt="YouTube">
            </a>
          <?php endif; ?>

          <?php if ($trip_adv): ?>
            <a href="<?php echo esc_url($trip_adv); ?>" target="_blank">
              <img src="<?php echo ASSET_URL; ?>images/trip-advisor.svg" class="img-fluid" alt="TripAdvisor">
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Navigation -->
  <nav>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-5">
          <a href="<?php echo home_url(); ?>" class="site-logo">
            <img src="<?php echo esc_url($logo); ?>" class="img-fluid" alt="Logo">
          </a>
        </div>
        <div class="col-lg-9 col-md-8 col-7 text-end">
          <div class="stellarnav">
            <?php
              wp_nav_menu([
                'theme_location' => 'main',
                'menu_class'     => 'main-menu',
                'container'      => false,
              ]);
            ?>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
  
  <?php if (!is_404() && !is_search() && !is_front_page()) { ?>
    <?php get_template_part("template-parts/global/breadcrumb"); ?> 
  <?php } ?>
<!-- <button class="openPopup">Search</button> -->

<div class="popupOverlay" style="display:none;"></div>

<div class="popupBox" style="display:none;">
    <div class="popupClose">✖</div>
    <div class="popupContent">
        <?php get_search_form(); ?>
    </div>
</div>



