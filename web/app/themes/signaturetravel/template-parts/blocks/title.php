<?php 
  $fields = get_fields();
  $title  = $fields['title'] ?? '';
  $align  = $fields['text_align'] ?? 'left';

  $class = match ($align) {
    'center' => 'text-center',
    'right'  => 'text-end',
    default  => 'text-start',
  };
?>

<?php if ($title): ?>
  <h2 class="main-title <?php echo esc_attr($class); ?>">
    <?php echo esc_html($title); ?>
  </h2>
<?php endif; ?>
