<?php 
  $fields = get_fields();
  $slider = $fields['slider'] ?? [];
?>
<?php if($slider): ?>
<div class="slider-section">
  <div class="swiper bannerSwiper">
    <div class="swiper-wrapper">
      <?php foreach($slider as $sli): 
        $image = $sli['image'] ?? [];
        $title = $sli['title'] ?? '';
        $link  = $sli['button'] ?? [];
      ?> 
      <div class="swiper-slide">
        <div class="slide-inner">
          <img src="<?php echo esc_url($image['url'] ?? ''); ?>" class="img-fluid kenburns" alt="<?php echo esc_attr($image['title'] ?? ''); ?>">
          <div class="overlay"></div>
          <div class="text-wrapper">
            <h1 class="text-white mb-4"><?php echo esc_html($title); ?></h1>
            <?php if(!empty($link['url'])): ?>
              <a href="<?php echo esc_url($link['url']); ?>" class="btn btn-primary"><?php echo esc_html($link['title']); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-pagination swiper-pagination-banner"></div>
  </div>
</div>
<?php endif; ?>
