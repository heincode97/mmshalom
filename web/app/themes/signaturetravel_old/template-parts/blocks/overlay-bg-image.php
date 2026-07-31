<div class="">
<?php 
  $fields = get_fields();
  $bg_type = $fields['bg_types'];
?>
<?php if($bg_type == 'bg_image') { 
  $bg_image = $fields['bg_image'];
?>
<div class="tailor-made-section" style="background-image: url(<?php echo $bg_image['url']; ?>);">
  <div class="overlay">
    <div class="content-box">
      <h4 class="tailor-title"><?php echo $fields['title']; ?></h4>
      <p>
        <?php echo $fields['info']; ?>
      </p>
      <a href="#" class="btn btn-primary"><?php echo $fields['button']['title']; ?></a>
    </div>
  </div>
</div>

<?php }elseif($bg_type == 'color') { ?>
    
<?php } ?>
</div>