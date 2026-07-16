<?php 
  $button = get_field('button');
  $align  = get_field('align') ?? 'left';

  $btn_type = get_field('button_type');
  
  if($btn_type == 'primary') {
    $aa = 'btn btn-primary';
  }elseif($btn_type == 'secondary') {
    $aa = 'btn btn-secondary';
  }else {
    $aa = 'btn btn-secondary alt';
  }
  $class = match ($align) {
    'center' => 'text-center',
    'right'  => 'text-end',
    default  => 'text-start',
  };

  $url    = $button['url'] ?? '#';
  $title  = $button['title'] ?? '';
  $target = !empty($button['target']) ? $button['target'] : '_self';
?>

<?php if ($title): ?>
  <div class="<?php echo esc_attr($class); ?>">
    <a href="<?php echo esc_url($url); ?>" 
       target="<?php echo esc_attr($target); ?>" 
       class="<?php echo $aa; ?>">
      <?php echo esc_html($title); ?>
    </a>
  </div>
<?php endif; ?>
